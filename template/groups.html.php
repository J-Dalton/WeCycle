<h1 class="text-center mt-5 display-2">Groups</h1>
<div class="container">
    <form method="post">
        <div class="row">
            <div class="col-md-7 d-flex align-items-end">
                <input class="btn btn-primary" type="submit" name="add-group-button" value="Create a New Group">
                <?php if (!empty($_GET['pattern'])): ?>
                    <button class="btn btn-primary mx-1" type="submit" name="reset_filter">Reset filter
                    </button>
                    <?php echo $totalgroups . " search results matching " . '"' . $_GET['pattern'] . '"' . " for " . $display_filter ?>
                <?php endif; ?>

            </div>
            <div class="col-md-5">
                <div class="float-left">
                    <label for="group_name">Group Name</label>
                    <input class="me-3" type="radio" name="groupfilter" id="group_name" value="group_name" <?php if ($_GET['filter'] == "group_name") {
                        echo "checked";
                    } ?> />
                    <label for="group_details">Group Details</label>
                    <input class="me-3" type="radio" name="groupfilter" id="group_details" value="group_details" <?php if ($_GET['filter'] == "group_details") {
                        echo "checked";
                    } ?> />
                    <label for="group_region">Group Region</label>
                    <input class="me-3" type="radio" name="groupfilter" id="group_region" value="group_region" <?php if ($_GET['filter'] == "group_region") {
                        echo "checked";
                    } ?> />

                </div>
                <div class="input-group">
                    <input class="form-control" type="search" name="search_groups" id="search-input">
                    <button class="btn btn-primary" type="submit" name="search_groups_btn">Search
                    </button>
                </div>
    </form>
</div>
<?php foreach ($groups as $group): ?>
    <?php $registeredcheck = checkIfUserRegistered($pdo, $group['group_id'], $_SESSION['id']); ?>
    <div class="row d-flex justify-content-center">
        <div class="col-sm-6 my-4 groupCards">
            <div class="card my-2 shadow-sm rounded border-0 text-center">
                <?php echo "<a href=viewGroup.php?group_id=" . $group['group_id'] . "><img src=" . $group['group_icon'] . ' class="card-img-top"></a>'; ?>
                <div class="card-body rounded-bottom border-0">
                    <h5 class="card-title"><b>
                            <?php echo $group['group_name'] ?>
                        </b>
                    </h5>
                    <p class="card-text">
                        <?php echo $group['group_details'] ?>
                    </p>
                    <p>
                        <?php echo "<i>" . $group["group_region"] . "</i>"; ?>
                    </p>
                    <?php if (!empty($registeredcheck)): ?>
                        <p class="card-text badge text-bg-success shadow">
                            <?php echo "Registered"; ?>
                        </p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>


<?php endforeach; ?>

</div>

<ul class="pagination paginationoverride">
    <?php for ($i = 1; $i <= ceil($totalgroups / $pagetotal); $i++) { ?>
        <li class="page-item <?php if ($i == $currentpage)
            echo 'active'; ?>">
            <a class="page-link" href="?page=<?php echo $i . '&filter=' . $_GET['filter'] . '&pattern=' ?><?php if (!empty($_GET['pattern'])) {
                         echo $_GET['pattern'];
                     } else {
                         echo '';
                     } ?>"><?php echo $i; ?></a>
        </li>
    <?php } ?>
</ul>