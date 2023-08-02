<?php if ($_GET['page'] == 1): ?>
    <div class="card mx-5 mt-5 shadow">
        <div class="card-header container-fluid py-0 pt-1">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-linkcolour" href="admin.php?page=2">Groups</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-linkcolour" href="admin.php?page=3">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-linkcolour" href="admin.php?page=4">Reported Comments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-linkcolour" href="admin.php?page=5">Sponsors</a>
                        </li>
                    </ul>
                    <form method="post">
                </div>
                <div class="col-md-6">
                    <div class="profilefilterform">
                    
                        <label class="px-2" for="first_name">First Name
                        <input type="radio" name="userfilter" id="first_name" value="first_name" <?php if ($_POST['userfilter'] == "first_name") {
                            echo "checked";
                        } ?> /></label>
                        <label class="px-2" for="last_name">Last Name
                        <input type="radio" name="userfilter" id="last_name" value="last_name" <?php if ($_POST['userfilter'] == "last_name") {
                            echo "checked";
                        } ?> /></label>

                        <label class="px-2" for="user_name">User Name
                        <input type="radio" name="userfilter" id="user_name" value="user_name" <?php if ($_POST['userfilter'] == "user_name") {
                            echo "checked";
                        } ?> /></label>

                        <label class="px-2" for="user_type">User Type
                        <input type="radio" name="userfilter" id="user_type" value="user_type" <?php if ($_POST['userfilter'] == "user_type") {
                            echo "checked";
                        } ?> /></label>

                        <button type="submit" class="btn btn-primary" name="apply_user_filter">Apply filter</button>
                        </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body py-0 px-0 ps-1">
            <table class="table table-hover my-0 table-borderless">

                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>User Name</th>
                    <th>Account type</th>
                    <th>Delete</th>
                </tr>
                <?php $num = 0 ?>
                <?php foreach ($alluserdata as $data): ?>
                    <tr>
                        <td>
                            <?php echo ($data['first_name']) ?>
                        </td>
                        <td>
                            <?php echo ($data['last_name']) ?>
                        </td>
                        <td>
                            <?php echo ($data['user_name']) ?>
                        </td>
                        <td>
                            <?php if (($data['user_type']) == "ADMIN") {
                                echo "Admin";
                            } else {
                                echo "Normal";
                            } ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target=<?php echo "#mod" . $num ?>>
                                Delete Account
                            </button>
                        </td>
                    </tr>

                    <div class="modal modalfade" id=<?php echo "mod" . $num ?> tabindex="-1" role="dialog"
                        aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel">Confirm Delete</h5>
                                </div>
                                <div class="modal-body">
                                    Are you sure you wish to delete this account? <br><br>
                                    This account will be removed from all groups/events and comments will also be
                                    deleted.<br><br>Are you sure you wish to Proceed?
                                    <?php $num++; ?>
                                </div>
                                <form method="post">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        <button value=<?php echo $data['user_id'] ?> type="submit" name="delete-account-button"
                                            class="btn btn-danger" data-bs-dismiss="modal">Delete Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
                
            </table>
        </div>
    </div>
<?php endif; ?>



<?php if ($_GET['page'] == 2): ?>
    <div class="card mx-5 mt-5 shadow rounded-bottom">
        <div class="card-header container-fluid py-1">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link nav-linkcolour" href="admin.php?page=1">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Groups</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-linkcolour" href="admin.php?page=3">Events</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link nav-linkcolour" href="admin.php?page=4">Reported Comments</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link nav-linkcolour" href="admin.php?page=5">Sponsors</a>
                        </li>
                        <form method="post">
                </div>
                <div class="col-md-6">
                    <div class="profilefilterform">
                        <label class="px-2" for="group_name">Group Name
                            <input type="radio" name="filter" id="group_name" value="group_name" <?php if ($_POST['filter'] == "group_name") {
                                echo "checked";
                            } ?> /></label>

                        <label class="px-2" for="group_region">Group region
                            <input type="radio" name="filter" id="group_region" value="group_region" <?php if ($_POST['filter'] == "group_region") {
                                echo "checked";
                            } ?> /></label>


                        <label class="px-2" for="user_name">Group owner
                            <input type="radio" name="filter" id="user_name" value="user_name" <?php if ($_POST['filter'] == "user_name") {
                                echo "checked";
                            } ?> /></label>
                        <button type="submit" class="btn btn-primary" name="apply_filter">Apply filter</button>


                        </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body mx-0 px-0 my-0 py-0">
            <?php if (!empty($allevents)): ?>

                <table class="table table-hover my-0 table-borderless">
                    <tr>

                        <th>Group Name</th>
                        <th>Group Region</th>
                        <th>Group Details</th>
                        <th>Group Owner</th>
                        <th>Group Link</th>
                        <th>Remove Group</th>
                    </tr>
                    <?php $grp_num = 0 ?>
                    <?php foreach ($allgroups as $group): ?>
                        <tr>

                            <td>
                                <?php echo htmlspecialchars($group['group_name'], ENT_QUOTES, 'utf-8') ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($group['group_region'], ENT_QUOTES, 'utf-8') ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($group['group_details'], ENT_QUOTES, 'utf-8') ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($group['user_name'], ENT_QUOTES, 'utf-8') ?>
                            </td>
                            <td>
                                <?php echo '<a href=' . "viewGroup.php?group_id=" . $group['group_id'] . '>Group page</a>' ?>
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target=<?php echo "#Modal" . $grp_num ?>>
                                    Delete Group
                                </button>

                                <div class="modal modalfade" id=<?php echo "Modal" . $grp_num ?> tabindex="-1" role="dialog"
                                    aria-labelledby="ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalLabel">Confirm Delete</h5>

                                            </div>
                                            <div class="modal-body">
                                                Deleting this event will remove all users. Are you sure you wish to Proceed?
                                                <?php $grp_num++; ?>
                                            </div>
                                            <form method="post">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>

                                                    <button value=<?php echo $group['group_id'] ?> type="submit"
                                                        name="delete-event-button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Delete Group</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            <?php endif; ?>

        </div>
    <?php endif; ?>


  


    <?php if ($_GET['page'] == 3): ?>
        <div class="card mx-5 mt-5 shadow rounded-bottom">
            <div class="card-header container-fluid py-1">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link nav-linkcolour" href="admin.php?page=1">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-linkcolour" href="admin.php?page=2">Groups</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Events</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-linkcolour" href="admin.php?page=4">Reported Comments</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-linkcolour" href="admin.php?page=5">Sponsors</a>
                            </li>
                            <form method="post">
                    </div>
                    <div class="col-md-6">
                        <div class="profilefilterform">
                            <label for="event_name">Event Name</label>
                            <input class="me-3" type="radio" name="eventfilter" id="event_name" value="event_name" <?php if ($_POST['eventfilter'] == "event_name") {
                                echo "checked";
                            } ?> />
                            <label for="event_location">Location</label>
                            <input class="me-3" type="radio" name="eventfilter" id="event_location" value="event_location"
                                <?php if ($_POST['eventfilter'] == "event_location") {
                                    echo "checked";
                                } ?> />
                            <label for="event_datetime">Date</label>
                            <input class="me-3" type="radio" name="eventfilter" id="event_datetime" value="event_datetime"
                                <?php if ($_POST['eventfilter'] == "event_datetime") {
                                    echo "checked";
                                } ?> />
                            <label for="is_event_owner">Owned Events</label>
                            <input class="me-3" type="radio" name="eventfilter" id="is_event_owner" value="is_event_owner"
                                <?php if ($_POST['eventfilter'] == "is_event_owner") {
                                    echo "checked";
                                } ?> />
                            <button type="submit" class="btn btn-primary" name="apply_event_filter">Apply
                                filter</button>
                            </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body mx-0 px-0 my-0 py-0">
                <?php if (!empty($allevents)): ?>

                    <table class="table table-hover my-0 table-borderless">
                        <tr>

                            <th>Event Name</th>
                            <th>Location</th>
                            <th>Date/Time</th>
                            <th>Event Owner</th>
                            <th>Event Link</th>
                            <th>Remove</th>
                        </tr>
                        <?php $eve_num = 0 ?>
                        <?php foreach ($allevents as $event): ?>
                            <tr>

                                <td>
                                    <?php echo htmlspecialchars($event['event_name'], ENT_QUOTES, 'utf-8') ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($event['event_location'], ENT_QUOTES, 'utf-8') ?>
                                </td>
                                <td>
                                    <?php $date = new Datetime($event['event_datetime']);
                                    $formatteddate = $date->format('d-m-Y H:i:s');
                                    ?>
                                    <?php echo htmlspecialchars($formatteddate, ENT_QUOTES, 'utf-8') ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($event['user_name'], ENT_QUOTES, 'utf-8') ?>
                                </td>
                                <td>
                                    <?php echo '<a href=' . "viewEvent.php?event_id=" . $event['event_id'] . '>Event page</a>' ?>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target=<?php echo "#Modal" . $eve_num ?>>Delete Event</button>

                                    <div class="modal modalfade" id=<?php echo "Modal" . $eve_num ?> tabindex="-1" role="dialog"
                                        aria-labelledby="ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalLabel">Confirm Delete</h5>

                                                </div>
                                                <div class="modal-body">
                                                    Deleting this event will remove all users. Are you sure you wish to Proceed?
                                            
                                                    <?php $eve_num++; ?>
                                                </div>
                                                <form method="post">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                        <button value=<?php echo $event["event_id"] ?> type="submit"
                                                            name="delete-event-button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Delete Group</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </table>

                <?php endif; ?>

            </div>
        <?php endif; ?>


        <?php if ($_GET['page'] == 4): ?>
            <div class="card mx-5 mt-5 shadow rounded-bottom">
                <div class="card-header container-fluid py-1">
                    <div class="row">

                        <div class="col-md-6">
                            <ul class="nav nav-tabs card-header-tabs pb-1">
                                <li class="nav-item">
                                    <a class="nav-link nav-linkcolour" href="admin.php?page=1">Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-linkcolour" href="admin.php?page=2">Groups</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-linkcolour" href="admin.php?page=3">Events</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Reported Comments</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-linkcolour" href="admin.php?page=5">Sponsors</a>
                                </li>
                                <form method="post">
                        </div>


                    </div>
                </div>

                <div class="card-body py-0 px-0 ps-1">
                    <table class="table table-hover my-0 table-borderless">
                        <tr>
                            <th>Comment content</th>
                            <th>Comment by</th>
                            <th>Report by</th>
                            <th>Report reason</th>
                            <th>Report details</th>
                            <th>Location</th>


                        </tr>
                        <?php $rep_num = 0 ?>
                        <?php foreach ($allreports as $report): ?>

                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($report['report_comment_content'], ENT_QUOTES, 'utf-8') ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($report['report_for'], ENT_QUOTES, 'utf-8') ?>
                                </td>
                                <td class="px-0">
                                    <?php echo htmlspecialchars($report['report_by'], ENT_QUOTES, 'utf-8') ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($report['report_reason'], ENT_QUOTES, 'utf-8') ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($report['report_details'], ENT_QUOTES, 'utf-8') ?>
                                </td>

                                <td>
                                    <?php ; ?>
                                    <?php echo '<a href=' . "Comments.php?event_id=" . getEventFromCommentId($pdo, $report['event_comments_id']) . '>Go to Comment</a>' ?>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target=<?php echo "#mod" . $rep_num ?>>
                                        Delete Comment
                                    </button>
                                    <div class="modal modalfade" id=<?php echo "mod" . $rep_num ?> tabindex="-1" role="dialog"
                                        aria-labelledby="ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalLabel">Confirm Delete</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Delete this comment?
                                                    <?php $rep_num++ ?>
                                                </div>
                                                <form method="post">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button value=<?php echo $report['event_comments_id'] ?> type="submit"
                                                            name="delete-comment-button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Delete Group</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </table>

                </div>
            <?php endif; ?>

            <?php if ($_GET['page'] == 5): ?>
                <div class="card mx-5 mt-5 shadow">
                    <div class="card-header container-fluid py-0 pt-1">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link nav-linkcolour" href="admin.php?page=1">Users</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-linkcolour" href="admin.php?page=2">Groups</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-linkcolour" href="admin.php?page=3">Events</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-linkcolour" href="admin.php?page=4">Reported Comments</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">Sponsors</a>
                                    </li>
                                </ul>
                                <form method="post">
                            </div>
                            <div class="col-md-6">
                                <div class="profilefilterform">
                                    <label for="sponsor_name">Sponsor Name</label>
                                    <input class="me-3" type="radio" name="spfilter" id="sponsor_name" value="sponsor_name"
                                        <?php if ($_POST['spfilter'] == "sponsor_name") {
                                            echo "checked";
                                        } ?> />
                                    <label for="sponsor_description">Sponsor Description</label>
                                    <input class="me-3" type="radio" name="spfilter" id="sponsor_description"
                                        value="sponsor_description" <?php if ($_POST['spfilter'] == "sponsor_description") {
                                            echo "checked";
                                        } ?> />
                                    <label for="sponsor_type">Sponsor Type</label>
                                    <input class="me-3" type="radio" name="spfilter" id="sponsor_type" value="sponsor_type"
                                        <?php if ($_POST['spfilter'] == "sponsor_type") {
                                            echo "checked";
                                        } ?> />
                                    <button type="submit" class="btn btn-primary" name="apply_sp_filter">Apply
                                        filter</button>
                                    </form>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body py-0 px-0 ps-1">
                        <table class="table table-hover my-0 table-borderless">

                            <tr>
                                <th>Sponsor Name</th>
                                <th>Sponsor Description</th>
                                <th>Sponsor Type</th>
                                <th><form method="post"><button type="submit" class="btn btn-primary" name="add_sponsor">
                                            Add Sponsor
                                        </button>
                                    </form>
                                    
                                </th>


                            </tr>
                            
                            <?php $sp_num = 0 ?>
                            <?php foreach ($allsponsors as $sponsor): ?>
                                <tr>
                                    <td>
                                    
                                        <?php echo ($sponsor['sponsor_name']) ?>
                                    </td>
                                    <td>
                                        <?php echo ($sponsor['sponsor_description']) ?>
                                    </td>
                                    <td>
                                        <?php echo ($sponsor['sponsor_type']) ?>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target=<?php echo "#mod" . $sp_num ?>>
                                            Delete Sponsor
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal modalfade" id=<?php echo "mod" . $sp_num ?> tabindex="-1" role="dialog"
                                    aria-labelledby="ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalLabel">Confirm Delete</h5>
                                            </div>
                                            <div class="modal-body">
                                                This sponsor will be removed from all groups and events.<br><br>
                                                Are you sure you wish to delete this sponsor? <br><br>
                                                <?php $sp_num++; ?>
                                            </div>
                                            <form method="post">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>

                                                    <button value=<?php echo $sponsor['sponsor_id'] ?> type="submit"
                                                        name="delete-sponsor-button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                    
                        </table>
                    </div>
                </div>
            <?php endif; ?>
            