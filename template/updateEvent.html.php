<container class="mx-5">
    <h1 class="titles-center mt-5">Update Event</h1>

    <div class="row mx-5">
        <div class="d-flex justify-content-center">
            <form method="post">
                <input class="btn btn-primary" type="submit" name="back-button" value="Back to Event">
            </form>
        </div>
    </div>

    <form method="POST" class="registerform">



        <div class="row">

            <div class="col-md-6">

                <div class="card my-2 rounded border-0 shadow">
                    <div class="card-body rounded border-0">

                        <table class="signup-table">
                            <tr>
                                <td><input class="rounded-2 my-2 border-glow" type="text" name="event_name" size="20"
                                        placeholder="Event Name"></td>
                            </tr>

                            <tr>
                                <td><input class="rounded-2 my-2 border-glow" type="datetime-local" id="event_datetime"
                                        name="event_datetime" min="<?php echo date("Y-m-d H:i") ?>" value="">
                                </td>
                            </tr>

                            <tr>
                                <td><input class="rounded-2 my-2 border-glow" type="text" name="event_details" size="20"
                                        placeholder="Details"></td>
                            </tr>

                            <tr>
                                <td><input class="rounded-2 my-2 border-glow" type="text" name="event_location"
                                        size="20" placeholder="Location"></td>
                            </tr>

                            <tr>
                                <td><select class="rounded-2 my-2 border-glow" id="event_type" name="event_type"
                                        title="event_type_selection">
                                        <option selected disabled hidden>Event Type</option>
                                        <option value="Casual">Casual</option>
                                        <option value="Beginner">Beginner</option>
                                        <option value="Training">Training</option>
                                        <option value="Coffee">Coffee</option>
                                        <option value="Tapering">Tapering</option>
                                        <option value="Injured/Downtime">Injured/Downtime</option>
                                        <option value="Triathlon">Triathlon</option>
                                        <option value="Elite">Elite</option>
                                        <option value="Other">Other</option>
                                    </select></td>
                            </tr>
                            <?php if ($_SESSION['Admin'] == "Y"): ?>
                                <tr>
                                    <td><select class="rounded-2 my-2 border-glow" id="event_sponsor" name="event_sponsor"
                                            title="Sponsored?">
                                            <option value="" selected disabled hidden>Sponsored?</option>
                                            <option value=1>Yes</option>
                                            <option value=0>No</option>

                                        </select></td>
                                </tr>

                            <?php endif; ?>
                            <?php if (!empty($owned_groups)): ?>
                                <tr>
                                    <td><select class="rounded-2 my-2 border-glow" id="event_grouphost"
                                            name="event_grouphost" title="event_grouphost_selection">
                                            <option value="">Not hosted</option>
                                            <?php foreach ($owned_groups as $groups) {
                                                echo '<option value=' . $groups['group_id'] . '>' . $groups['group_name'] . '</option>';
                                            } ?>
                                        </select></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td><input class="rounded-2 my-2 border-glow w-100" type="number" min="1" max="30"
                                        name="event_capacity" placeholder="Capacity (1 - 30)">
                                </td>
                            </tr>

                        </table>

                        <div class="signup-button">
                            <input class="btn btn-primary" type="submit" name="reg-event-button" value="Update Event">
                        </div>
                    </div>
                </div>
            </div>
    </form>

    <div class="col-md-6">
        <div class="card my-2 rounded border-0 shadow">
            <div class="card-body rounded border-0">
                <h5>Current Details</h5>
                <table class="signup-table">
                    <?php foreach ($currenteventdetails as $event): ?>
                        <tr>
                            <td>
                                <p>
                                    <?php echo "<b>Event name: </b>" . $event['event_name']; ?>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <?php $date = new Datetime($event['event_datetime']); ?>
                            <?php $formatteddate = $date->format('d-m-Y H:i:s'); ?>
                            <td>
                                <p>
                                    <?php echo "<b>Event date: </b>" . $formatteddate ?>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    <?php echo "<b>Event details: </b>" . $event['event_details']; ?>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    <?php echo "<b>Event location: </b>" . $event['event_location']; ?>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    <?php echo "<b>Event type: </b>" . $event['event_type']; ?>
                                </p>
                            </td>
                        </tr>


                        <tr>
                            <?php foreach ($relatedgroup as $group): ?>
                                <p>
                                    <td>
                                        <?php echo "<b>Host: </b>" . $group['group_name'] ?>
                                    </td>
                                </p>
                            <?php endforeach; ?>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    <?php echo "<b>Event Capacity:</b> " . $event['event_capacity']; ?>
                                </p>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </div>

        <?php
        if (isset($errormessage[7])) {
            foreach ($errormessage[7] as $eventnameexistserror) {
                echo "<div class='eventerrorpos rounded border-0 shadow alert alert-danger my-0'>" .
                    '<div class="rounded border-0">' .
                    '<p class="loginform">' . "$eventnameexistserror" . "</p>" .
                    '</div>' .
                    '</div>';

            }
        }
        ;
        ?>

</container>