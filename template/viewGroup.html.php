<div class="container my-4">
    <div class="row">
        <form method="post">
            <button type="submit" class="btn btn-primary my-3" name="back_button">Return to Groups</button>
        </form>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php foreach ($group as $g): ?>
                <div class="card shadow-sm rounded-bottom border-0 text-center">

                    <img src=<?php echo $g['group_icon']; ?> class="img-fluid rounded-top" alt="...">
                    <div class="card-body rounded-bottom border-0">

                        <h3>
                            <?php echo $g['group_name']; ?>
                        </h3>

                        <p>
                            <?php echo $g["group_details"]; ?>
                        </p>
                        <p>
                            <?php echo "<i>" . $g["group_region"] . "</i>"; ?>
                        </p>


                        <?php if (!empty($groupownercheck)): ?>


                            <form method="post">
                                <button type="submit" value=<?php echo $_GET["group_id"] ?> class="btn btn-primary"
                                    name="editgroup">Edit
                                    Group</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
                                    Delete Group
                                </button>

                            </form>



                        <?php endif; ?>


                    <?php endforeach; ?>


                    <?php if (empty($groupownercheck)): ?>
                        <?php if (empty($registeredcheck)): ?>

                            <form method="post">
                                <button type="submit" class="btn btn-primary" name="register">Register</button>
                            </form>
                        <?php else: ?>

                            <form method="post">
                                <button type="submit" class="btn btn-danger" name="unregister">Unregister</button>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>



        <div class="col-md-4">
            <h3>Registered Users -
                <?php echo $totalmembers ?>
            </h3>
            <div class="card rounded border-0 overflowy h-50">
                <div class="card-body rounded border-0">

                    <?php if (empty($grouppersonnames)): ?>
                        <p>No users have registered yet.</p>
                    <?php else: ?>
                        <ul class="list-group">
                            <?php $grp_num = 0 ?>
                            <?php foreach ($grouppersonnames as $persons): ?>
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <?php $findOwner = checkIfGroupOwner($pdo, $persons['user_id'], "YES", $_GET['group_id']); ?>
                                        <?php echo $persons['first_name'] . " " . $persons['last_name']; ?>
                                        <?php if (!empty($findOwner)): ?>
                                            <p class="card-text badge text-bg-dark mx-1 my-0 shadow">
                                                <?php echo "Owner" ?>
                                            </p>
                                        <?php endif; ?>
                                        <?php if (!empty($groupownercheck) && $persons['user_id'] != $_SESSION['id']): ?>
                                            <form method="post">
                                                <button value=<?php echo $persons['user_id'] ?> type="button" data-bs-toggle="modal"
                                                    class="btn btn-danger" data-bs-target=<?php echo "#Modal" . $grp_num ?>>Unregister</button>
                                            </form>


                                        </div>
                                    <?php endif; ?>

                                </li>
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
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button value=<?php echo $persons['user_id'] ?> type="submit" name="adminUnregister" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Unregister</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

            </div>
        </div>


        <div class="col-md-4">
            <h3>Group Events</h3>
            <div class="h-50 overflowy px-3">
                <?php foreach ($groupevents as $g_events): ?>
                    <div class="card my-2 rounded border-0">
                        <div class="card-body rounded border-0 px-0 py-2">
                            <div class="row py-3 px-3">
                                <div class="col-md-12 h5">
                                    <?php if (empty($groupevents)): ?>
                                        <?php echo "No events to show just yet..." ?>
                                    <?php endif; ?>
                                    <h5 class="card-title">
                                        <?php echo $g_events['event_name']; ?>
                                    </h5>
                                    <p class="card-text badge text-bg-info">
                                        <?php $date = new Datetime($g_events['event_datetime']);
                                        $formatteddate = $date->format('d-m-Y H:i:s');
                                        ?>
                                        <?php echo $formatteddate; ?>
                                    </p>
                                    <p class="card-text badge text-bg-primary">
                                        <?php echo $g_events['event_type']; ?>
                                    </p>
                                    <p class="card-text badge text-bg-light">
                                        <?php echo $g_events['event_location']; ?>
                                    </p>
                                    <p class="card-text">
                                        <?php echo $g_events['event_details']; ?>
                                    </p>
                                    <?php echo '<a href=' . "viewEvent.php?event_id=" . $g_events["event_id"] . '>Event page</a>' ?>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>




                <?php endforeach; ?>
            </div>


            <form method="post">
                <div class="modal modalfade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Confirm Delete</h5>
                            </div>
                            <div class="modal-body">
                                Deleting this group will remove all users. Are you sure you wish to Proceed?
                            </div>
                            <form method="post">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button value=<?php echo $_GET["group_id"] ?> type="submit"
                                        name="delete-group-button" class="btn btn-danger" data-bs-dismiss="modal">Delete
                                        Group</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>