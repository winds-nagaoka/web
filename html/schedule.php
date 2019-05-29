<?php
  // 初期設定
  date_default_timezone_set('Asia/Tokyo');
  $dir['data'] = DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR;

  // データ取得
  $list = file(dirname(__FILE__).$dir['data'].'schedule.inc',FILE_IGNORE_NEW_LINES);

  //コンテンツ処理(schedule)
  $weekjp = ['日', '月', '火', '水', '木', '金', '土'];
  $weeken = ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'];
  $contents['next'] = '直近の練習予定はありません。';
  $contents['article'] = '';
  $timestamp['present'] = date('Y/m/d H:i');
  $timestamp['today'] = date('Y/m/d');

  $nextflag = FALSE;
  $todayflag = '';

  for($i=0;$i<count($list);$i++) {
    $timestamp['end'] = date('Y/m/d H:i',strtotime(explode('<>',$list[$i]) [0].' '. explode('-', explode('<>',$list[$i])[1] ) [1] ));
    $date = explode('<>',$list[$i])[0];
    $start = explode('-',explode('<>',$list[$i])[1])[0];
    $end = explode('-',explode('<>',$list[$i])[1])[1];
    $place = explode('<>',$list[$i])[2];
    $studio = explode('<>',$list[$i])[3];
    $studio = preg_replace('/第(.*)スタジオ/','第<span>$1</span>スタジオ',$studio);
    $memo = explode('<>',$list[$i])[4];
    if($timestamp['end'] >= $timestamp['present'] && $nextflag == FALSE) {
      if(strtotime($timestamp['today']) === strtotime($date)){
        $todayflag = '<p class="todayflag">本日</p>';
      }
      $contents['next'] = $todayflag . '<p><span class="frame"><span class="month-date"><span class="month">'.preg_replace('/0([1-9])/','$1',explode('-',$date)[1]).'</span><span class="month text">月</span><span class="date">'.preg_replace('/0([1-9])/','$1',explode('-',$date)[2]).'</span><span class="date text">日</span><span class="day '.$weeken[date('w',strtotime($date))].'">'.$weekjp[date('w',strtotime($date))].'</span></span><span class="time">'.$start.'～'.$end.'</span></span>'
      .'<span class="frame"><span class="place">'.$place.'</span><span class="studio">'.$studio.'</span></span></p>';
      $nextflag = explode('-',$date)[1];
      //$contents['article'] .= '<p class="month-gap"></p>';
  	}
    if($nextflag) {
      if(explode('-',$date)[1] > $nextflag || ($nextflag == '12' && explode('-',$date)[1] < $nextflag)) {
        $contents['article'] .= '<p class="month-gap"></p>';
        $nextflag = preg_replace('/0([1-9])/','$1',explode('-',$date)[1]);
      }
      $contents['article'] .= '<p class="each"><span class="frame"><span class="month-date"><span class="month">'.preg_replace('/0([1-9])/','$1',explode('-',$date)[1]).'</span><span class="month text">月</span><span class="date">'.preg_replace('/0([1-9])/','$1',explode('-',$date)[2]).'</span><span class="date text">日</span><span class="day '.$weeken[date('w',strtotime($date))].'">'.$weekjp[date('w',strtotime($date))].'</span></span><span class="time">'.$start.'～'.$end.'</span></span><span class="frame"><span class="place">'.$place.'</span><span class="studio">'.$studio.'</span></span></p>';
    }
  }

?><html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1.0">
  <title>練習日程｜ザ・ウィンド・アンサンブル</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/schedule.css">
  <link rel="shortcut icon" href="image/favicon.ico">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>
  <script>
    ((d) => {
      var config = { kitId: 'wxw0kpr', scriptTimeout: 3000, async: true },
      h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
    })(document)
  </script>
</head>
<body>

  <header id='top'>
    <section id="main-logo">
      <a href='index.php'>
        <?php require('image/logo/logo.svg'); ?>
      </a>
    </section>
  </header>

  <div class='top-title'>
    <div>
      <h1 data-subttl="Schedule">練習日程</h1>
      <div class='bread'><a href='index.php'>ホーム</a><i class="fas fa-chevron-right"></i><a href='schedule.php'>練習日程</a></div>
    </div>
  </div>

  <div class='block next-schedule' id="next-schedule">
    <div class='title'>
      <h2 data-subttl="Next">次回の練習日</h2>
    </div>
    <div class='contents'>
      <div class='schedule-next'>
        <div>
          <?php echo $contents['next']; ?>
        </div>
      </div>
    </div>
  </div>

  <div class='block after-schedule' id="after-schedule">
    <div class='title'>
      <h2 data-subttl="Schedule">今後の練習日程</h2>
    </div>
    <div class='contents'>
      <div class='schedule-after'>
        <div>
          <?php echo $contents['article']; ?>
        </div>
      </div>
    </div>
  </div>

  <div class='block back-to-home'>
    <div>
      <a href='index.php'>ホームへ戻る</a>
    </div>
  </div>

  <footer>
    <div>
      <div class='author'>
        <a href='index.php'><?php require('image/logo/logo.svg'); ?></a>
        <small>&copy; The Wind Ensemble 1985-<?php echo date('Y'); ?> All Rights Reserved.</small>
      </div>
      <div class='link'>
        <ul>
          <li><a href='https://member.winds-n.com'>団員専用ページ</a></li>
          <li><a href='policy.php'>個人情報保護方針</a></li>
        </ul>
      </div>
    </div>
  </footer>
  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
