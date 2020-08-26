<?php
include './conf.php';
// $csrf_token = "ランダムな文字列";
// $_SESSION['csrf_token'] = $csrf_token;

?>


<html>

<head>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/jquery.min.js"></script>

</head>

<body>

    <!-- <header class="header">
        <div class="logo"></div>
        <div class="header-title">
            <h1>第22回日本褥瘡学会学術集会　オンライン展示　特設サイト</h1>
        </div>

    </header> -->

    <main class="main">
        <div class="logo"></div>
        <div class="title">
            <h1>第22回日本褥瘡学会学術集会　オンライン展示　特設サイト</h1>
        </div>

        <div class="description">
            メンリッケヘルスケア株式会社の特設サイトへようこそ！<br>
            メンリッケヘルスケア株式会社では、弊社製品に関しますアンケートをご用意しております。<br>
            ご回答頂いた場合、ご希望の方には特製トートバックをお送り致します。<br>
            （ご発送は9月末予定）
            <br><br><br>
            アンケートはこちらからどうぞ↓
        </div>

        <div class="form">

            <form action="POST">
                <div class="form-item">
                    <label class="form-label">Q1<span class="require">(必須)</span>
                        メピレックスボーダーフレックスに使用しているドレッシング材の柔軟性を向上させる技術の名前は何ですか？
                    </label>

                    <?php $q = 'question1' ?>
                    <?php foreach ($question1 as $key => $val) : ?>
                        <?php $id = "{$q}-${key}" ?>
                        <div class="form-radio-wrap">
                            <input type="radio" name="<?php echo $q ?>" id="<?php echo $id ?>" value="<?php echo $key ?>" />
                            <label for="<?php echo $id ?>"><?php echo $val ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="form-item">
                    <label class="form-label">Q2<span class="require">(必須)</span>次の文のOOOOに入る語句を選んでください。</label>
                    <p class="question">[メピレックス ボーダー プロテクトは独自のOOOOによって、摩擦やずれを予防する皮膚保護パッドです。]</p>
                    <?php $q = 'question2' ?>
                    <?php foreach ($question2 as $key => $val) : ?>
                        <?php $id = "{$q}-${key}" ?>
                        <div class="form-radio-wrap">
                            <input type="radio" name="<?php echo $q ?>" id="<?php echo $id ?>" value="<?php echo $key ?>" />
                            <label for="<?php echo $id ?>"><?php echo $val ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="form-item">
                    <label class="form-label">Q3<span class="require">(必須)</span>メンリッケヘルスケアでは、新しく創傷治療に携わる医療従事者のみなさまを対象としたエデュケーションサイトをオープンさせました。このエデュケーションサイトの名前は？ </label>
                    <?php $q = 'question3' ?>
                    <?php foreach ($question3 as $key => $val) : ?>
                        <?php $id = "{$q}-${key}" ?>
                        <div class="form-radio-wrap">
                            <input type="radio" name="<?php echo $q ?>" id="<?php echo $id ?>" value="<?php echo $key ?>" />
                            <label for="<?php echo $id ?>"><?php echo $val ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>


                <div class="description">

                    ご協力ありがとうございました。<br><br><br>

                    特製ロゴ入りトートバッグをご希望の方は、下記にご入力お願い致します。（＊は必須項目です）

                </div>

                <div class="form-item">
                    <label class="form-label">お名前<span class="require">＊</span></label>
                    <input class="form-input" type="text" name='name' require placeholder="お名前">
                </div>

                <div class="form-item">
                    <label class="form-label">電子メール<span class="require">＊</span></label>
                    <input class="form-input" type="email" name='email' require='true' placeholder="電子メール">
                </div>

                <div class="form-item">
                    <label class="form-label">ご職業<span class="require">＊</span></label>
                    <select name="jobs" class='form-select' placeholder="選択してください">
                        <?php foreach ($jobs as $key => $val) : ?>
                            <option value="<?php echo $key ?>"><?php echo $val ?></option>
                        <?php endforeach; ?>
                    </select>


                    <input class="form-input" type="email" name='email' require='true' placeholder="その他の方は詳細のご記入をお願い致します。">

                </div>


                <div class="form-item">
                    <label class="form-label">ご住所<span class="require">＊</span></label>
                    <input class="form-input" type='text' name='zip-code' require placeholder="郵便番号＊">
                    <input class="form-input" type='text' name='prefecture' require placeholder="都道府県＊">
                    <input class="form-input" type='text' name='city' require placeholder="市区町村＊">
                    <input class="form-input" type='text' name='address' require placeholder="番地＊">
                    <input class="form-input" type='text' name='address' require placeholder="ご所属施設名＊">
                </div>

                <div class="form-item">

                    <label class="form-label">今後メンリッケヘルスケア株式会社からのセミナーや製品についてのご案内といった情報を今後お受け取りになられることをご希望の場合は”はい”を選択して下さい。<span class="require">＊</span></label>

                    <div class="policy-wrapper">
                        <?php $name = 'notification' ?>
                        <?php foreach ($notification as $key => $val) : ?>
                            <?php $id = "$name-${key}" ?>
                            <span class="form-radio-wrap">
                                <input type="radio" name="<?php echo $name ?>" id="<?php echo $id ?>" value="<?php echo $key ?>" />
                                <label for="<?php echo $id ?>"><?php echo $val ?></label>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-item">
                    <div class="policy-wrapper">
                        <label class="form-label">Mölnlyckeのリーガルとプライバシーポリシーに同意致します。<span class="require">＊</span></label>　
                        <input type="checkbox" name="policy" id="policy" class="checkbox" value="1">
                        <p class="policy-note" id="submit-note">
                            いいえを選択された場合でも、トートバッグ発送のご連絡のためにE-mailでご連絡申し上げる場合がございます。
                        </p>
                        <p class="policy-note" id="submit-note">
                            Box 13080, Gamlestadvägen 3C, SE-40252 Göteborg, Sweden. Privacy Policy The Mölnlycke trademark, name and respective logo are registered globally to one or more of the Mölnlycke Health Care Group of Companies. © 2020 Mölnlycke Health Care AB. All rights reserved.
                        </p>
                        </p>
                    </div>
                </div>


                <input type='submit' class="btn" id="submit" value="送信" disabled></a>
                <p class="submit-note" id="submit-note"> ※プライバシーポリシーに同意いただかないと送信出来ません。</p>
            </form>
        </div>
    </main>

    <script src="/js/app.js"></script>


</body>


</html>