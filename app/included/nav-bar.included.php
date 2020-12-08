<div class="nav-bar">
    <div>
        <a href="/">
            <img src="/assets/icons/logo.icon.png">
        </a>
        <input class="search-bar" type="text" placeholder="<?= $lang['search-bar'] ?>">
        <span>
            <?php
            if (isset($_SESSION['username'])) {
                echo "<a href='/user/". $_SESSION['username'] . "'>" . $_SESSION['username'] . "</a>";
            } else {
                echo "<a href='/login'>Login</a>";
            }
            ?>
            <select class="languages">
                <?php
                foreach ($languages as $key => $value) {
                    if ($value == $_COOKIE['language']) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }

                    echo "<option value='$value' $selected>" . $key . "</option>";
                }
                ?>
            </select>
        </span>
    </div>
</div>

<script>
$(document).ready(function() {
    $(".search-bar").bind("keypress", function(e) {
        if (e.keyCode == 13) {
            var query = $(this).val();
            window.location.href = "/search/" + query;
        }
    });

    // saves the current language in the cookies and update the page
    $(".languages").on("change", function() {
        var language = $(this).val();
        document.cookie = "language = " + language + "; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/";
        location.reload();
    });
});
</script>