<form method="get">
    <fieldset>
    <legend>Search</legend>
    <input type="hidden" name="route" value="search-title">
        <?= $searchTitle = "";?>
    <p>
        <label>Title (use % as wildcard):
            <input type="search" name="searchTitle" value="<?= $searchTitle ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
    <p><a href="?">Show all</a></p>
    </fieldset>
</form>
