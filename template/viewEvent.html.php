<div class="container my-4">
    <div class="row">
        <form method="post">
            <button type="submit" class="btn btn-primary my-3" name="back_button">Return to Events</button>
        </form>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php if (!empty($icon)): ?>
                <?php foreach ($icon as $img): ?>
                    <div class="col-sm-12 registerform mh-25">
                        <div class="card shadow-sm rounded-bottom border-0 text-center">
                            <?php echo "<a href=viewGroup.php?group_id=" . $img['group_id'] . "><img src=" . $img['group_icon'] . ' class="img-fluid rounded-top"></a>'; ?>
                            <div class="card-body rounded-bottom border-0">
                                <h5 class="card-title">
                                    <?php echo $img['group_name'] ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $img['group_details'] ?>
                                </p>
                            </div>
                        </div>
                    </div>




                <?php endforeach; ?>
            <?php endif; ?>

        </div>


        <div class="col-md-4">
            <?php foreach ($event as $e): ?>
                <div class="card rounded shadow-sm border-0">
                    <div class="card-body rounded shadow-sm border-0">
                        <h3 class="card-title">
                            <?php echo $e['event_name']; ?>
                        </h3>
                        <h5 class="card-title">
                            <?php if (!empty($eventownercheck)): ?>
                                <?php echo "<i>Event owned by you</i>" ?>
                            <?php else: ?>
                                <?php foreach ($eventownername as $owner):
                                    echo "<i>Event owned by " . $owner['first_name'] . " " . $owner['last_name'] . '</i><br><br>';
                                endforeach; ?>
                            <?php endif; ?>
                        </h5>
                        <p>
                            <?php echo $e['event_details'] . '<br>'; ?>
                        </p>
                        <p class="badge text-bg-primary shadow">
                            <?php echo $e['event_type'] . '<br>'; ?>
                        </p>

                        <p class="card-text badge text-bg-light shadow">
                            <?php echo $e['event_location']; ?>
                        </p>

                        <p class="card-text badge text-bg-info shadow">
                            <?php $date = new Datetime($e['event_datetime']);
                            $formatteddate = $date->format('d-m-Y H:i:s');
                            ?>
                            <?php echo $formatteddate; ?>
                        </p>

                        <?php if (!empty($eventownercheck)): ?>


                            <form method="post" class="d-flex justify-content-between mx-3">
                                <button type="submit" value=<?php echo $_GET["event_id"] ?> class="btn btn-primary"
                                    name="edit_event_button">Edit Event</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#DeleteModal">
                                    Delete Event
                                </button>
                                <?php echo "<a href=Comments.php?event_id=" . $_GET["event_id"] . ">Comments(" . $comment_count . ")</a>" ?>

                            <?php else: ?>
                                <?php if (empty($registeredcheckevent)): ?>
                                    <?php if ($fail_count > 0 || $registered == $capacity): ?>

                                        <button type="submit" class="btn btn-primary" name="register" disabled>Register</button>


                                    </form>
                                    <?php foreach ($users_existing_events as $a): ?>
                                        <?php foreach ($this_events_details as $c): ?>
                                            <?php if (strtotime($a['event_datetime']) - strtotime($c['event_datetime']) < 7200 && (strtotime($a['event_datetime']) - strtotime($c['event_datetime']) > -7200)) {
                                                echo "<p class='text-danger text-center'>The start time for this event is within 2 hours of the following event: " . '<a href=' . "viewEvent.php?event_id=" . $a["event_id"] . '>Event page</a>'
                                                    . "<br>Clashing Times:<br> " . $c['event_datetime'] . " <br> " . $a['event_datetime'] . '</p>';
                                            } ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <form method="post" class="d-flex justify-content-between mx-3">
                                        <button type="submit" class="btn btn-primary" name="register">Register</button>
                                        <?php echo "<a href=Comments.php?event_id=" . $_GET["event_id"] . ">Comments(" . $comment_count . ")</a>" ?>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <form method="post" class="d-flex justify-content-between mx-3">
                                    <button type="submit" class="btn btn-danger" name="unregister">Unregister</button>
                                    <?php echo "<a href=Comments.php?event_id=" . $_GET["event_id"] . ">Comments(" . $comment_count . ")</a>" ?>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="col-md-4">


            <?php if (empty($eventpersonnames)): ?>
                <p>No users have registered yet.</p>
            <?php else: ?>
                <ul>

                    <div class="card rounded border-0 shadow">
                        <div class="card-body rounded border-0">
                            <?php echo "<h3>Registered: (" . $registered . "/" . $e['event_capacity'] . ")</h3>"; ?>
                            <?php $grp_num = 0 ?>
                            <?php foreach ($eventpersonnames as $names): ?>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <?php $findOwner = checkIfEventOwner($pdo, $names['user_id'], "YES", $_GET['event_id']); ?>
                                            <?php echo $names['first_name'] . " " . $names['last_name']; ?>
                                            <?php if (!empty($findOwner)): ?>
                                                <p class="card-text badge text-bg-dark mx-1 my-0 shadow">
                                                    <?php echo "Owner" ?>
                                                </p>
                                            <?php endif; ?>
                                            <?php if (!empty($eventownercheck) && $names['user_id'] != $_SESSION['id']): ?>
                                                <form method="post">
                                                    <button value=<?php echo $names['user_id'] ?> type="button"
                                                        data-bs-toggle="modal" class="btn btn-danger" name="adminUnregister"
                                                        data-bs-target=<?php echo "#Modal" . $grp_num ?>>Unregister</button>


                                                </form>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                </ul>

                                <div class="modal modalfade" id=<?php echo "Modal" . $grp_num ?> tabindex="-1" role="dialog"
                                    aria-labelledby="ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalLabel">Confirm Unregister</h5>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you wish to unregister this user?
                                                <?php $grp_num++ ?>
                                            </div>
                                            <form method="post">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button value=<?php echo $names['user_id'] ?> type="submit"
                                                        name="remove-user-button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Unregister User</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            <?php endforeach; ?>
                        </div>
                    </div>

                </ul>
            <?php endif; ?>


        </div>

    </div>
</div>



<form method="post">
    <div class="modal modalfade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Confirm Delete</h5>
                </div>
                <div class="modal-body">
                    Deleting this event will remove all users. Are you sure you wish to Proceed?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button value=<?php echo $_GET["event_id"] ?> type="submit" name="delete-event-button"
                        class="btn btn-danger" data-bs-dismiss="modal">Delete
                        Event</button>
                </div>

            </div>
        </div>
    </div>
</form>

<?php if (!empty($sponsor_names)): ?>
    <container>
        <h3 class="text-center display-5">Event Sponsors</h3>
        <h3 class="text-center">Check out some of our partners below for special discounts only available to WeCycle
            members!</h3>
        <?php $num = 0; ?>
        <?php foreach ($sponsor_names as $name): ?>
            <?php $test = sponsorProducts($pdo, $name['sponsor_name'], $_GET['event_id']) ?>
            <?php $sp_count = 0 ?>
            <div class="d-flex justify-content-center">
                <div class="card rounded border-0 shadow my-3 w-75">
                    <div class="card-body rounded border-0">
                        <div class="row">
                            <div class="col-md-12">


                                <div class="text-center">
                                    <?php echo "<b><p class='display-4'>" . $name['sponsor_name'] . "</p></b>" ?>
                                    <?php echo "<p>" . $name['sponsor_description'] . "</p>" ?>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-around">
                                <?php foreach ($test as $sponsor): ?>


                                    <div class="text-center">
                                        <div class="card shadow-lg border-0" style="width: 18rem;">
                                            <img src=<?php echo $sponsor['sp_img'] ?> class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?php echo "<p>" . $sponsor['sp_description'] . "</p>" ?>
                                                </h5>
                                                <div class="card-text">
                                               
                                                    <p class="badge rounded-pill bg-warning text-dark">
                                                        <?php echo $sponsor['sp_discount'] . "% off" ?>
                                                    </p>
                                                  
                                                </div>
                                                <div class="my-1">
                                                    <a href=<?php echo $sponsor['sp_hyperlink'] ?>>Product Page</a>
                                                </div>
                                                <?php if ($_SESSION['Admin'] == "Y"): ?>
                                                    <p>
                                                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target=<?php echo "#mod" . $num ?>
                                                            name="remove_item">Remove</button>
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    </div>




                                    <div class="modal modalfade" id=<?php echo "mod" . $num ?> tabindex="-1" role="dialog"
                                        aria-labelledby="ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalLabel">Confirm Delete</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you wish to remove this item?
                                                    <?php $num++; ?>
                                                </div>
                                                <form method="post">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                        <button value=<?php echo $sponsor['event_sponsor_id'] ?> type="submit"
                                                            name="remove-item-button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Remove Item</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>
</container>