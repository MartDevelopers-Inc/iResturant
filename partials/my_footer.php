<?php
/*
 * Created on Fri Jul 09 2021
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 MartDevelopers Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */


/* Load System COnfigurations And Settings */
$ret = "SELECT * FROM `iResturant_System_Details`  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>
    <div class="row align-items-center">
        <div class="col-lg-7">
            <div class="copy-right padding-top-30px">
                <p class="copy__desc">
                    &copy; <?php echo $sys->system_name; ?>. Copyright 2020. Made with
                    <span class="la la-heart"></span> By <a href="https://martdev.info">Mart Developers Inc</a>
                </p>
            </div><!-- end copy-right -->
        </div><!-- end col-lg-7 -->
        <div class="col-lg-5">
            <div class="copy-right-content text-right padding-top-30px">
                <ul class="social-profile">
                    <li><a href="<?php echo $sys->sys_facebook; ?>"><i class="lab la-facebook-f"></i></a></li>
                    <li><a href="<?php echo $sys->sys_twitter; ?>"><i class="lab la-twitter"></i></a></li>
                    <li><a href="<?php echo $sys->sys_instagram; ?>"><i class="lab la-instagram"></i></a></li>
                    <li><a href="<?php echo $sys->sys_linked_in; ?>"><i class="lab la-linkedin-in"></i></a></li>
                </ul>
            </div><!-- end copy-right-content -->
        </div><!-- end col-lg-5 -->
    </div><!-- end row -->
<?php } ?>