<container class="mx-4">
    <div class="d-flex justify-content-center">
        <div class="display-5 text-center">
            <?php echo $title ?>"
        </div>
    </div>
    
    <div class="row mx-4">
        <div class="col-md-2">
        </div>

        <div class="col-md-8">
        <form method="post">
        <button type="submit" class="btn btn-primary" name="back_button">Return to Event</button>
    </form>
            <?php if (empty($eventcomments)): ?>
                <p>No comments so far :(</p>
            <?php else: ?>
                <?php foreach ($eventcomments as $comments): ?>
                    <div class="card rounded shadow-sm border-0 my-1">
                        <div class="card-body rounded shadow-sm border-0">
                            <h5 class="card-title">
                                <?php echo $comments['first_name'] . " " . $comments['last_name']; ?>
                            </h5>
                            <p class="card-subtitle mb-2 text-muted">
                                <?php $date = new Datetime($comments['comment_date']);
                                $formatteddate = $date->format('d-m-Y H:i:s');
                                ?>
                                <?php echo $formatteddate; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $comments['comment_content']; ?>
                            </p>
                            <?php if ($comments['user_id'] == $_SESSION['id']): {
                                echo '<a href=' . "deleteComment.php?event_comments_id=" . $comments["event_comments_id"] . '> Delete</a>&nbsp';
                            } ?>
                            <?php else: ?>
                                <?php echo '<a href=' . "report.php?event_comments_id=" . $comments["event_comments_id"] . '&user_id=' . $comments["user_id"] . ' class="card-link">Report</a>' ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <form method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter comment" aria-describedby="button-addon2"
                        name="comment_content">
                    <button class="btn btn-primary" type="submit" name="comment-button">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-md-2">
        </div>

    </div>
</container>