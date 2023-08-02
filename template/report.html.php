<h1 class="titles-center mt-5">Report a comment</h1>

<form method="POST" class="registerform">
    <div class="card my-2 rounded border-0 shadow">
        <div class="card-body rounded border-0">

            <table class="signup-table">

                <?php foreach ($event_comment as $comment) {

                    echo '<p>' . $comment['comment_content'] . '</p>';
                } ?>

                <tr>
                    <td><select class="rounded-2 my-2 border-glow" id="report_reason" name="report_reason"
                            title="report_type_selection" required>
                            <option value="" selected disabled hidden>Report reason</option>
                            <option>Fraud/Spam</option>
                            <option>Illegal activity</option>
                            <option>Supporting or promoting hate/terror group</option>
                            <option>Discrimination</option>
                            <option>Racism or Sexism</option>
                            <option>Other - please detail below</option>
                        </select></td>
                </tr>

                <tr>
                    <td><textarea class="rounded-2 my-2 border-glow form-control no-resize" maxlength="230" type="text"
                            name="report_details" size="30" rows="4" placeholder="Report details" required></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                    <?php foreach ($event_comment as $comment):?>
                        <div class="login-button">
                            <input class="btn btn-primary my-2" type="submit" name="submit-report" value="Submit">
                        </div>
                        <?php endforeach;?>
                    </td>
                </tr>
            </table>
</form>