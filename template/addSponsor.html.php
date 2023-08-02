<h1 class="titles-center mt-5">Add Sponsor</h1>

<form method="POST" class="registerform">
    <div class="card my-2 rounded border-0 shadow">
        <div class="card-body rounded border-0">

            <table class="signup-table">
                <tr>
                    <td><input class="rounded-2 my-2 border-glow" type="text" name="sponsor_name" size="20"
                            placeholder="Sponsor Name" required></td>
                </tr>


                <tr>
                    <td><input class="rounded-2 my-2 border-glow" type="text" name="sponsor_description" size="20"
                            placeholder="Sponsor Description" required></td>
                </tr>


                <tr>
                    <td><select class="rounded-2 my-2 border-glow" id="sponsor_type" name="sponsor_type"
                            title="event_type_selection" required>
                            <option value="" selected disabled hidden>Sponsor Type</option>
                            <option>Cycling</option>
                            <option>Outdoor Activities</option>
                            <option>Maintenance/Repair</option>
                            <option>Wellbeing/Mental Health</option>
                            <option>Coffee/Social</option>
                            <option>Triathlon/MultiSports</option>
                            <option>Other</option>
                        </select></td>
                </tr>


            </table>

            <div class="signup-button">
                <input class="btn btn-primary" type="submit" name="reg-sponsor-button" value="Register Sponsor">
            </div>

        </div>
    </div>
</form>


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