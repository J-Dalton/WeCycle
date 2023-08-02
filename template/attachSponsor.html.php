<h1 class="titles-center mt-5">Attach Sponsor and Products</h1>

<form method="POST" class="registerform">
    <div class="card my-2 rounded border-0 shadow">
        <div class="card-body rounded border-0">

            <table class="signup-table">
                <tr>
                    <td><select class="rounded-2 my-2 border-glow" id="sponsor_name" name="sponsor_name"
                            title="sponsor_name" required>
                            <option value="" selected disabled hidden>Sponsor</option>
                            <?php foreach ($allsponsors as $sponsor): ?>
                                <option>
                                    <?php echo $sponsor['sponsor_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select></td>
                </tr>

                <tr>
                    <td><input class="rounded-2 my-2 border-glow" type="text" name="sp_description" size="20"
                            placeholder="Item description" required></td>
                </tr>

                <tr>
                    <td><input class="rounded-2 my-2 border-glow w-100" type="number" min="1" max="100"
                            name="product_discount" placeholder="Discount (1 - 100)" required></td>
                </tr>


                <tr>
                    <td><select class="rounded-2 my-2 border-glow" id="img_ref" name="img_ref" title="img_ref" required>
                            <option value="" selected disabled hidden>Product image</option>
                            <option value="sponsor/helmet.png">Helmet</option>
                            <option value="sponsor/frame.png">Frame</option>
                            <option value="sponsor/tyre.png">Tyre</option>

                        </select></td>
                </tr>

                <tr>
                    <td> <input class="rounded-2 my-2 border-glow" type="text" name="sp_link" size="20"
                            placeholder="Item Link" required></td>
                </tr>




                <tr>
                    <td>
                        <div class="signup-button">
                            <input class="btn btn-primary" type="submit" name="submit_row_data" value="Finished Adding">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="signup-button">
                            <input class="btn btn-primary" type="submit" name="add_another_item" value="Add another">
                        </div>
                    </td>
                </tr>

            </table>


        </div>
    </div>

</form>