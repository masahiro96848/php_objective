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
    $enemyIndex = rand(0, count($enemies)-1 );  // 添字は0から始まるので、　-1する
    $enemy = $enemies[$enemyIndex];
    // 白魔導士の場合、味方のオブジェクトも渡す
    if(get_class($member) == "WhiteMage") {
      $member->doAttackWhiteMage($enemy, $member);
    }else {
      $member->doAttack($enemy);
    }
    echo "\n";
  }
  echo "\n";


  // 敵の攻撃
  foreach ($enemies as $enemy) {
      $memberIndex = rand(0, count($members) - 1); // 添字は0から始まるので、-1する
      $member = $members[$memberIndex];
      $enemy->doAttack($member);
      echo "\n";
  }
    echo "\n";

  // $tiida->doAttack($goblin);
  // echo "\n";
  // $goblin->doAttack($tiida);
  // echo "\n";

  $turn++;

}
echo "★★★ 戦闘終了 ★★★\n\n";
echo $tiida->getName() . "　：　" . $tiida->getHitPoint() . "/" . $tiida::MAX_HITPOINT . "\n";
echo $goblin->getName() . "　：　" . $goblin->getHitPoint() . "/" . $goblin::MAX_HITPOINT . "\n\n";