<!doctype html>
<html lang="en-US" itemscope itemtype="http://schema.org/WebSite" prefix="og: http://ogp.me/ns#">
<head>
    <title>ClickJack | Open Source Suspicious URL checker</title>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />

    <meta name="robots" content="noodp, noydir" />
    <meta name="description" content="Safely check suspicious links without visiting them." />

    <meta property="og:type" content="website" />
    <meta property="og:title" content="ClickJack | Open Source Suspicious URL checker" />
    <meta property="og:description" content="Safely check suspicious links without visiting them." />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="ClickJack" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="ClickJack | Open Source Suspicious URL checker" />
    <meta name="twitter:description" content="Safely check suspicious links without visiting them." />

    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins%3A400%2C500%2C600%7CPoppins%3A400%2C500%2C600" media="screen" />
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css" media="screen" />
    <link rel="stylesheet" href="assets/css/minified.css.php" media="screen" />

    <link rel="icon" href="favicon.png" type="image/x-icon" />
</head>

<body id="index">

    <!-- wrapper -->
    <div id="wrapper">

        <!-- header -->
        <header id="main">
            <div class="boxed">

                <!-- nav -->
                <nav id="primary">
                    <div id="site-logo">
                        <h1><a href="#"><i class="fas fa-unlink"></i> ClickJack</a></h1>
                    </div>

                    <ul>
                        <li><a href="//github.com/scottparry/clickjack"><i class="fab fa-github"></i> View Source</a></li>
                    </ul>
                </nav>
                <!-- /nav -->

                <!-- intro -->
                <div id="intro" class="textcenter">
                    <h2>Suspicious URL checker</h2>
                    <p>
                        Many SPAM emails contain suspicious links that have been passed through URL shorteners<br>to disguise their true location. ClickJack helps you safely check the suspicious links without ever visiting them.<br>Simply paste in the URL and click fetch link to see it's true location.
                    </p>
                </div>
                <!--/intro -->

                <!-- form -->
                <form id="checker" action="" method="post">
                    <?php
                        if ( isset( $_POST['suspiciouslink'] ) && filter_var( $_POST['suspiciouslink'], FILTER_VALIDATE_URL ) ) :
                            $url = $_POST['suspiciouslink'];
                        else :
                            $url = "";
                        endif;

                        $ch = curl_init($url);

                        curl_setopt( $ch, CURLOPT_URL, $url );
                        curl_setopt( $ch, CURLOPT_HEADER, true );
                        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
                        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

                        $a      = curl_exec( $ch );
                        $url    = curl_getinfo( $ch, CURLINFO_EFFECTIVE_URL );
                        $domain = parse_url( $url );

                        curl_close($ch);
                    ?>
                    <div class="one-full">
                        <label for="suspiciouslink">Link to Check</label>
                        <input type="text" id="suspiciouslink" value="" name="suspiciouslink" autocorrect="off" autocapitalize="none" autocomplete="off" />
                        <i class="fas fa-unlink"></i>
                    </div>

                    <button type="submit" id="fetch">Fetch Link</button>

                    <?php if ( isset( $_POST['suspiciouslink'] ) && filter_var( $_POST['suspiciouslink'], FILTER_VALIDATE_URL ) ) : ?>
                        <div id="reallink" class="one_full textcenter">
                            <p class="alert alert-info"><?php echo strip_tags( trim( $url ) ); ?></p>
                            <p><a class="button button-large button-green" href="http://www.google.com/safebrowsing/diagnostic?site=<?php echo $domain['host']; ?>" title="Check this link with Google Safe Browsing" target="_blank">Check this link with Google Safe Browsing</a></p>
                        </div>
                    <?php endif; ?>
                </form>
                <!-- /form -->

            </div>
        </header>
        <!-- /header -->

    </div>
    <!-- /wrapper -->

    <!-- footer -->
    <footer id="main">
        <div id="copyright" class="boxed">
            <p>
	            Released under the <a href="//github.com/scottparry/clickjack/blob/master/LICENSE" target="_blank">GPL v3 license</a>.

                Copyright &copy; <?php echo date('Y'); ?> <a href="#"><i class="fas fa-unlink"></i> ClickJack</a>.
                <br>
                Icons by <a href="//fontawesome.com/" target="_blank">FontAwesome</a>.
            </p>
        </div>
    </footer>
    <!-- /footer -->
</body>
</html>