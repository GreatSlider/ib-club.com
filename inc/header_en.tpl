    <!--========================================================
                              HEADER
    =========================================================-->
    <header>
        <div id="stuck_container" class="stuck_container">
            <div class="container">

                <div class="navbar-header">
                    <h1 class="navbar-brand">
                        <a data-type='rd-navbar-brand' href="/index_en.html">IBC
                            <small>INTERNATIONAL<br/>BUSINESS CLUB</small>
                        </a>
                    </h1>
                </div>

                <?php require_once("nav_en.tpl");?>

                <a class="search-form_toggle" href="#"></a>

            </div>

            <div class="search-form">
                <div class="container">
                    <form id="search" action="search.php" method="GET" accept-charset="utf-8">
                        <label class="search-form_label" for="in">
                            <input id="in" class="search-form_input" type="text" name="s"
                                   placeholder="Enter search term..."/>
                            <span class="search-form_liveout"></span>
                        </label>
                        <button type="submit" class="search-form_submit fa-search"></button>
                    </form>
                </div>
            </div>

        </div>
    </header>