<?php 
    include("control.php")
?>
<form action="otp.php" method="POST" autocomplete="off">
                    <h2 class="text-center" style="color: white;">Code Verification</h2>
                    <?php 
                    if(isset($_SESSION['info']))
                    {
                        ?>
                        <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                            <?php 
                                echo $_SESSION['info']; 
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0)
                    {
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror)
                            {
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="center">
                      <div class="form-group">
                          <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
                      </div>
                      <div class="form-group">
                          <input class="form-control button" type="submit" name="check-reset-otp" value="Submit">
                      </div>
                  </div>
                </form>