<h1 class="titles-center mt-5">Create an Event</h1>

<form method="POST" class="registerform">
    <div class="card my-2 rounded border-0 shadow">
        <div class="card-body rounded border-0">

            <table class="signup-table">
                <tr>
                    <td><input class="rounded-2 my-2 border-glow" type="text" name="event_name" size="20"
                            placeholder="Event Name" required></td>
                </tr>

                <tr>
                    <td><input class="rounded-2 my-2 border-glow" type="datetime-local" id="event_datetime"
                            name="event_datetime" min="<?php echo date("Y-m-d H:i") ?>"
                            value="<?php echo date("Y-m-d H:i") ?>" required>
                    </td>
                </tr>

                <tr>
                    <td><input class="rounded-2 my-2 border-glow" type="text" name="event_details" size="20"
                            placeholder="Details" required></td>
                </tr>

                <tr>
                    <td><input class="rounded-2 my-2 border-glow" type="text" name="event_location" size="20"
                            placeholder="Location" required></td>
                </tr>

                <tr>
                    <td><select class="rounded-2 my-2 border-glow" id="event_type" name="event_type"
                            title="event_type_selection" required>
                            <option value="" selected disabled hidden>Event Type</option>
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
                                title="Sponsored?" required>
                                <option value="" selected disabled hidden>Sponsored?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                                
                            </select></td>
                    </tr>

                <?php endif; ?>

                <?php if (!empty($owned_groups)): ?>
                    <tr>
                        <td><select class="rounded-2 my-2 border-glow" id="event_grouphost" name="event_grouphost"
                                title="event_grouphost_selection">
                                <option value="">Not hosted</option>
                                <?php foreach ($owned_groups as $groups) {
                                    echo '<option value=' . $groups['group_id'] . '>' . $groups['group_name'] . '</option>';
                                } ?>
                            </select></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td><input class="rounded-2 my-2 border-glow w-100" type="number" min="1" max="30"
                            name="event_capacity" placeholder="Capacity (1 - 30)" required>
                    </td>
                </tr>

            </table>

            <div class="signup-button">
                <input class="btn btn-primary" type="submit" name="reg-event-button" value="Register Event">
            </div>
</form>
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