<?php

// echo '処理のはじまりはじまり〜！\n\n';

// ファイルのロード
require_once('./classes/Human.php');
require_once('./classes/Enemy.php');
require_once('./classes/Brave.php');
require_once('./classes/BlackMage.php');
require_once('./classes/WhiteMage.php');

// インスタンス化
$members = array();
$members[] = new Brave('ディーダ');
$members[] = new WhiteMage('ユウナ');
$members[] = new BlackMage('ルールー');

$enemies = array();
$enemies[] = new Enemy('ゴブリン', 20);
$enemies[] = new Enemy('ボム', 25);
$enemies[] = new Enemy('モルボル', 30);

// $tiida = new Brave('ティーダ');
// $goblin = new Enemy('ゴブリン');


// ターン数
$turn = 1;

$isFinishFlg = false;

// どちらかのHPが0になるまで繰り返す
while(!$isFinishFlg){
  echo "*** $turn ターン目 ***\n\n"; 

  // echo $tiida->name . "\n";
  // echo $goblin->name . "\n";

  // 現在のHPの表示
  foreach($members as $member) {
    echo $member->getName() . "　：　" . $member->getHitPoint() . "/" . $member::MAX_HITPOINT . "\n";
  }
  echo "\n";
  foreach($enemies as $enemy) {
    echo $enemy->getName() . "　：　" . $enemy->getHitPoint() . "/" . $enemy::MAX_HITPOINT . "\n";
  }
  echo "\n";

  // echo $goblin->getName() . "　：　" . $goblin->getHitPoint() . "/" . $goblin::MAX_HITPOINT . "\n";

  // 味方の攻撃
  foreach($members as $member) {
    // 白魔導士の場合、味方のオブジェクトも渡す
    if(get_class($member) == "WhiteMage") {
      $member->doAttackWhiteMage($enemies, $members);
    }else {
      $member->doAttack($enemies);  // 配列を渡すように変更
    }
    echo "\n";
  }
  echo "\n";


  // 敵の攻撃
  foreach ($enemies as $enemy) {
      $enemy->doAttack($members);
      echo "\n";
  }
    echo "\n";

  // $tiida->doAttack($goblin);
  // echo "\n";
  // $goblin->doAttack($tiida);
  // echo "\n";

  // 仲間の全滅チェック
  $deathCnt = 0;  // HPが0以下の仲間の数
  foreach($members as $member) {
    if($member->getHitPoint() > 0) {
      $isFinishFlg = false;
      break;
    }
    $deathCnt++;
  }
  if($deathCnt === count($members)) {
    $isFinishFlg = true;
    echo 'GAME OVER.....';
    break;
  }

  // 敵の全滅チェック
  $deathCnt = 0; // HPが0以下の敵の数
  foreach ($enemies as $enemy) {
    if ($enemy->getHitPoint() > 0) {
        $isFinishFlg = false;
        break;
    }
    $deathCnt++;
  }
  if ($deathCnt === count($enemies)) {
    $isFinishFlg = true;
    echo "♪♪♪ファンファーレ♪♪♪\n\n";
    break;
  }

  $turn++;

}
echo "★★★ 戦闘終了 ★★★\n\n";
// echo $tiida->getName() . "　：　" . $tiida->getHitPoint() . "/" . $tiida::MAX_HITPOINT . "\n";
// echo $goblin->getName() . "　：　" . $goblin->getHitPoint() . "/" . $goblin::MAX_HITPOINT . "\n\n";

// 現在のHPの表示
foreach ($members as $member) {
    echo $member->getName() . "　：　" . $member->getHitPoint() . "/" . $member::MAX_HITPOINT . "\n";
}
echo "\n";
foreach ($enemies as $enemy) {
    echo $enemy->getName() . "　：　" . $enemy->getHitPoint() . "/" . $enemy::MAX_HITPOINT . "\n";
}