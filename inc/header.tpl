    <!--========================================================
                              HEADER
    =========================================================-->
    <header>
        <div id="stuck_container" class="stuck_container">
            <div class="container">

                <div class="navbar-header">
                    <h1 class="navbar-brand">
                        <a data-type='rd-navbar-brand' href="./">IBC
                            <small>INTERNATIONAL<br/>BUSINESS CLUB</small>
                        </a>
                    </h1>
                </div>

                <?php require_once("nav.tpl");?>
                <a class="btn btn-info btn-enter" href="#">Стать партнёром</a>
                <a class="search-form_toggle" href="#"></a>

            </div>

            <div class="search-form">
                <div class="container">
                    <form id="search" action="search.php" method="GET" accept-charset="utf-8">
                        <label class="search-form_label" for="in">
                            <input id="in" class="search-form_input" type="text" name="s"
                                   placeholder="Задайте поисковый запрос..."/>
                            <span class="search-form_liveout"></span>
                        </label>
                        <button type="submit" class="search-form_submit fa-search"></button>
                    </form>
                </div>
            </div>

        </div>
    </header>