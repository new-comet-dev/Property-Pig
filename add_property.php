<?php 
include 'header.php'; 
if(!isset($_SESSION['user_id']))
{
     echo("<script>location.href = '".$base_url."signin.php';</script>");
}
?>       
<!-----page section---->
<style>
    label{margin-bottom: 0px;}
    .form-group {margin-bottom: 5px;}
    .radio-but-holder {
    margin-top: 10px;
    width: initial;
    padding: 0px 4px;
}
</style>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

<script src="https://www.propertypig.co.uk/assets/js/getaddress.js"></script>

<div class="ndiv page-section">

    <div class="ndiv top-banner-section">
        <div class="ndiv primary-center-holder">
            <div class="ndiv primary-center-in">
                <div class="ndiv banner-content-holder">
                    <div class="ndiv banner-text-section">
                        <div class="ndiv text-holder">
                            <p class="pmzero banner-text-one">
Get An INSTANT Cash Offer For Your Home                           </p>
                            <p class="pmzero banner-text-two">
Property Pig pay all surveyors, lawyers and selling fees.
                            </p>
                        </div>
                    </div>
                    <div class="ndiv banner-input-section">
                        <div class="ndiv pig-image-holder">
                            <img class="imgres input-pig-image" alt="register pig" src="<?php echo $assets; ?>image/pigbg.png" />
                        </div>
                        <div class="ndiv pig-input-section-holde">                            
                            <div class="ndiv files-of-registration">
                                <div id="part1">
                                    <form action="javascript:void(0);" id="form_list" name="form_list" method="POST" onsubmit="return Submit_form();">

                                        <p class="pmzero register-header">Enter your Property Details</p>
                                        <?php
                                        $obj1 = new commonFunctions();
                                        $i = 1;
                                        $dbh = $obj1->dbh;
                                        $status = false;
                                        $row = '';
                                        $query = $dbh->prepare("select * from pig_questions where peradd='1' order by id asc");
                                        $query->execute();
                                        $counts_questions = $query->rowCount();
                                        if ($query->rowCount() > 0) {
                                            $status = true;
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <div class="ndiv filelds-holder">


                                                    <?php if ($row['type'] == 1 || $row['type'] == 3) { ?>
                                                        <div class="form-group">
                                                            <label><?php echo $row['question']; ?></label>
                                                        </div>
                                                    <?php } ?>    

                                                    <?php
                                                    if ($row['type'] == 1) {
                                                        ?>

                                                        <?php
                                                $rows =$row['id'];
                                                $querye = $dbh->prepare("select * from pig_answer where question_id=:rows");
                                                $querye->bindParam(":rows",$rows);
                                                        $querye->execute();
                                                         
                                                        if ($querye->rowCount() > 0) {
                                                            while ($row_questions = $querye->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>

                                                                <div class="ndiv radio-but-holder">
                                                                    <div class="ndiv radio-lable">
                                                                        <input type="radio" name="optionsRadios<?php echo $row['id']; ?>" id="optionsRadios<?php echo $row['id'] . $row_questions['answer_id']; ?>" value="<?php echo $row_questions['answer']; ?>">
                                                                    </div>
                                                                    <div class="ndiv radio-lable-text">
                                                                        <?php echo $row_questions['answer']; ?>
                                                                    </div>
                                                                </div>


                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    <?php } else if ($row['type'] == 2 && $row['id'] == 32) { ?>
<input class="register-fields" placeholder="<?php echo $row['question']; ?>" id="txt<?php echo $row['id']; ?>"
name="txt<?php echo $row['id']; ?>" type="hidden"/>
<?php } else if ($row['type'] == 2 && $row['id'] == 40) { ?>
<input class="register-fields" placeholder="<?php echo $row['question']; ?>" id="txt<?php echo $row['id']; ?>"
name="txt<?php echo $row['id']; ?>" type="hidden"/>
<?php } else if ($row['type'] == 2 && $row['id'] == 39) { ?>
<input class="register-fields" placeholder="<?php echo $row['question']; ?>" id="txt<?php echo $row['id']; ?>"
name="txt<?php echo $row['id']; ?>" type="hidden"/>
<?php } else if ($row['type'] == 2 && $row['id'] == 33) { ?>
 <input class="register-fields" placeholder="<?php echo $row['question']; ?>" id="txt<?php echo $row['id']; ?>" name="txt<?php echo $row['id']; ?>" type="hidden"/> <div 
id="postcode_lookup"></div>

<div id="postcode_lookup"></div>  

<?php } else if ($row['type'] == 2 && $row['id'] !== 33 && $row['id'] !== 32  && $row['id'] !== 39) { ?>
                                                        <input class="register-fields" placeholder="<?php echo $row['question']; ?>" id="txt<?php echo $row['id']; ?>"  
name="txt<?php echo $row['id']; ?>" />   <?php } else if ($row['type'] == 3) { ?>
                                                        <input type="radio" name="options<?php echo $row['id']; ?>" id="optionsRadiosYes" value="yes"> Yes
                                                        <span style="margin-left: 10px;"></span>
                                                        <input type="radio" name="options<?php echo $row['id']; ?>" id="optionsRadiosNo" value="no"> No
                                                    <?php } else if ($row['type'] == 4) {
                                                        ?>
                                                        <select  class="register-fields property-type" id="dropdownval<?php echo $row['id']; ?>" name="dropdownval<?php echo $row['id']; ?>">
                                                            <option value=""><?php echo $row['question']; ?></option>
                                                            <?php
                                                            $rows=$row['id'];
                                                            $querys = $dbh->prepare("select * from pig_answer where question_id=:rows");
                                                            $querys->bindParam(":rows",$rows);

                                                            $querys->execute();
                                                            if ($querys->rowCount() > 0) {
                                                                while ($row_questions_list = $querys->fetch(PDO::FETCH_ASSOC)) {
                                                                    ?><option value="<?php echo $row_questions_list['answer']; ?>"><?php echo ucfirst(str_replace("_", " ", $row_questions_list['answer'])); ?> </option>  <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php
                                                    } else {
                                                        
                                                    }
                                                    ?>




                                                </div>

                                                <?php
                                                $i++;
                                            }
                                            ?>

                                            <button class="get-my-cash-offer" type="submit" >Get My Cash Offer</button>




                                            <?php
                                        }
                                        ?>
                                    </form>
                                </div>
                                <div id="part2" style="display: none;">

                                    <form action="javascript:void(0);" id="form_list2" name="form_list2" method="POST" onsubmit="return Submit_part2_form();">

                                        <p class="pmzero register-header">Enter your Property Details</p>
                                        <?php
                                        $obj1 = new commonFunctions();
                                        $i = 1;
                                        $dbh = $obj1->dbh;
                                        $status = false;
                                        $row = '';
                                        $query = $dbh->prepare("select * from pig_questions where peradd='0' order by id asc");
                                        $query->execute();
                                        $counts_questions = $query->rowCount();
                                        if ($query->rowCount() > 0) {
                                            $status = true;
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <div class="ndiv filelds-holder">


                                                    <?php if ($row['type'] == 1 || $row['type'] == 3) { ?>
                                                        <div class="form-group">
                                                            <label><?php echo $row['question']; ?></label>
                                                        </div>
                                                    <?php } ?>    

                                                    <?php
                                                    if ($row['type'] == 1) {
                                                        ?>

                                                        <?php
                                                         $rows=$row['id'];
                                                        $querye = $dbh->prepare("select * from pig_answer where question_id=:rows");
                                                        $querye->bindParam(":rows",$rows);

                                                        $querye->execute();
                                                        if ($querye->rowCount() > 0) {
                                                            while ($row_questions = $querye->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>

                                                                <div class="ndiv radio-but-holder">
                                                                    <div class="ndiv radio-lable">
                                                                        <input type="radio" name="optionsRadios<?php echo $row['id']; ?>" id="optionsRadios<?php echo $row['id'] . $row_questions['answer_id']; ?>" value="<?php echo $row_questions['answer']; ?>">
                                                                    </div>
                                                                    <div class="ndiv radio-lable-text">
                                                                        <?php echo $row_questions['answer']; ?>
                                                                    </div>
                                                                </div>


                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    <?php } else if ($row['type'] == 2) { ?>
                                                        <input class="register-fields" placeholder="<?php echo $row['question']; ?>" id="txt<?php echo $row['id']; ?>"  name="txt<?php echo $row['id']; ?>"  />
                                                    <?php } else if ($row['type'] == 3) { ?>
                                                        <input type="radio" name="options<?php echo $row['id']; ?>" id="optionsRadiosYes" value="yes"> Yes
                                                        <span style="margin-left: 10px;"></span>
                                                        <input type="radio" name="options<?php echo $row['id']; ?>" id="optionsRadiosNo" value="no"> No
                                                    <?php } else if ($row['type'] == 4) {
                                                        ?>
                                                        <select  class="register-fields property-type" id="dropdownval<?php echo $row['id']; ?>" name="dropdownval<?php echo $row['id']; ?>">
                                                            <option value=""><?php echo $row['question']; ?></option>
                                                            <?php
                                                            $rows=$row['id'];
                                                            $querys = $dbh->prepare("select * from pig_answer where question_id=:rows");
                                                            $querys->bindParam(":rows",$rows);

                                                            $querys->execute();
                                                            if ($querys->rowCount() > 0) {
                                                                while ($row_questions_list = $querys->fetch(PDO::FETCH_ASSOC)) {
                                                                    ?><option value="<?php echo $row_questions_list['answer']; ?>"><?php echo ucfirst(str_replace("_", " ", $row_questions_list['answer'])); ?> </option>  <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php
                                                    } else {
                                                        
                                                    }
                                                    ?>




                                                </div>

                                                <?php
                                                $i++;
                                            }
                                            ?>

                                            <button class="get-my-cash-offer" type="submit" >Get My Chash Offer</button>




                                            <?php
                                        }
                                        ?>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

       <div class="ndiv sectio-2-content">
        <div class="ndiv primary-center-holder">
            <div class="ndiv primary-center-in">

                <div class="ndiv top-potions">
                    <div class="ndiv ndiv-1in2 sections" blue>
                        <h6 class="pmzero title-text">Welcome to Property Pig</h6>
                        <p class="pmzero content">

Property Pig are the market leading fast property buying company in the UK. <br><br>We buy any house and will give you a cash offer instantly using our Property Pig App regardless of its condition or location.
<br><br>So if you need to sell your house fast, Property Pig will help with absolutely no cost to the seller. </br>Property Pig pay all fees including surveyor fees, lawyers fees and sale fees. </br></br>We have the cash ready to buy your house quickly, with no pain or fuss. We’ve been helping people to sell their property fast for over 5 years now. 
</br></p>                    </div>
                    <div class="ndiv ndiv-1in2 sections" green image>
                        <p class="pmzero image-section-header">
Property Pig have helped thousands of homeowners sell fast with no viewings or estate agents<br><p>

                        </p>
                        <div class="ndiv explore-but-holder">
<!--                            <button class="btn_click">EXPLORE</button> -->
                        </div>
                        <div class="ndiv image-section-of-conter">
                            <img style="margin-bottom: 9px;" class="imgres content-image1" alt="contet image" src="<?php echo $assets; ?>image/image-1.png" />
                        </div>

                    </div>
                </div> 

                <div class="ndiv top-potions">
                    <div class="ndiv ndiv-1in2 sections" vilot image>
                        <p class="pmzero image-section-header">
Uploading photos could help us offer you more money!
                        </p>
                        <!--<div class="ndiv explore-but-holder"
                            <button class="btn_click">EXPLORE</button>
                        </div>-->
                        <div class="ndiv image-section-of-conter">
                            <img class="imgres content-image2" alt="contet image" src="<?php echo $assets; ?>image/image-2.png" style="margin-bottom:15px;"/>
                        </div>
                    </div>
                    <div class="ndiv ndiv-1in2 sections" pink>
                        <h6 class="pmzero title-text">How We Can Help</h6>
                        <p class="pmzero content">
About to have your property repossessed?</br></br> Property Pig can help no matter how little time is left. </br></br>
Unlike most other 'We Buy Any Home' companies, we construct our offer by performing a property search valuation through our trusted partners Zoopla. </br></br>Our customers use our sell your house fast service for its convenience and flexibility – and we’ll truly buy any house, in any condition and in any location within the UK, within a timescale that best suits you.<br>
                    </div>
                </div> 

            </div>
        </div>
    </div>


</div>





<!--    <select id="amazing-select-1">-->
<!--                                                
                                                	<option>property 1</option>
                                                    <option>property 2</option>
                                                    <option>property 3</option>
                                                    <option>property 4</option>
                                                
                                                </select>    -->
        
        
<!----/page section---->
<script>
$('#postcode_lookup').getAddress({
});
</script>
<?php include 'footer.php'; ?> 

<!----- popup script ------------>
<script src="<?php echo $assets; ?>js/break-bs-popup.js"></script>
<!----------select - js -------->
<script src="<?php echo $assets; ?>js/amazing_select.js"></script>

<script>  
    /*click to animate move up code here*/
    
        $(".btn_click").on("click", function () {
            $("html, body").animate({scrollTop: 0}, "slow");
        });
        
    /*click to animate move up code end here*/
                                            
    /*form validation code and save session*/                                          
     function Submit_form(id)
    {
        <?php
        $query = $dbh->prepare("select * from pig_questions where peradd='1' order by id asc");
        $query->execute();
        $counts_questions = $query->rowCount();
        if ($query->rowCount() > 0) 
        {
            $status = true;
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
            {
                switch ($row['type']) 
                {
                    case 1: {
                            ?>
                            if ($('[name="optionsRadios' +<?php echo $row['id']; ?> + '"]:checked').length == 0)
                            {
                                $('.yello-menu').trigger('click');
                                $('.popup-header').html('');
                                $('.popup-message').html('');
                                $('.popup-header').html('NOTIFICATION');
                                $('.popup-message').html('Please Enter The <?php echo $row['question']; ?>');
                                return false;
                            }
                            <?php
                            break;
                        }
                    case 2: {
 if ($row['id'] != 39 && $row['id'] != 40) {                         
                            ?>
                            if ($('#txt' +<?php echo $row['id']; ?>).val() == '')
                            {
                                $('.yello-menu').trigger('click');
                                $('.popup-header').html('');
                                $('.popup-message').html('');
                                $('.popup-header').html('NOTIFICATION');
                                $('.popup-message').html('Please Choose The <?php echo $row['question']; ?>');
                                $('#txt' +<?php echo $row['id']; ?>).focus();
                                return false;

                            }
                            <?php }
                            break;
                        }
                    case 3: {
                            ?>
                            if ($('[name="options' +<?php echo $row['id']; ?> + '"]:checked').length == 0)
                            {
                                $('.yello-menu').trigger('click');
                                $('.popup-header').html('');
                                $('.popup-message').html('');
                                $('.popup-header').html('NOTIFICATION');
                                $('.popup-message').html('Please Choose The <?php echo $row['question']; ?>');
                                return false;

                            }
                            <?php
                            break;
                        }
                    case 4: {
                            ?>
                            if ($('#dropdownval' +<?php echo $row['id']; ?>).val() == '')
                            {
                                $('.yello-menu').trigger('click');
                                $('.popup-header').html('');
                                $('.popup-message').html('');
                                $('.popup-header').html('NOTIFICATION');
                                $('.popup-message').html('Please Select The <?php echo $row['question']; ?>');
                                $('#dropdownval' +<?php echo $row['id']; ?>).focus();
                                return false;
                            }
                            <?php
                            break;
                        }
                    default: {
                            ?>
                            $('.yello-menu').trigger('click');
                            $('.popup-header').html('');
                            $('.popup-message').html('');
                            $('.popup-header').html('NOTIFICATION');
                            $('.popup-message').html('Invalid Data');
                            return false;
                            <?php
                        }
                }
            }

        }
        ?>
        /*step process save in session*/         
        processExe1();
        /*step process save in session end here*/ 
        return false;
    }   
        
    /*form validation code and save session end here*/ 
    
    /*step 1 process*/ 
    function processExe1()
    {
        <?php
        $query = $dbh->prepare("select * from pig_questions where peradd='0' and validation='1' order by id asc");
        $query->execute();
        $counts_questions_part2 = $query->rowCount();
        if($counts_questions_part2>0)
        {
            $url="exe_single_step.php";       
        }
        else
        {
            $url='question_process_add.php';
        }
        
        if(isset($_SESSION['user_id'])) 
        {
            ?>
            $.ajax({
                type: "POST",
                data: $('#form_list').serialize(),
                url: "<?php echo $base_url.$url; ?>",
                success: function (result) {
                    console.log(result);
                    $('.yello-menu').trigger('click');
                    if (result == 1)
                    {
                        $('.popup-header').html('NOTIFICATION');
                        <?php
                        if($counts_questions_part2>0)
                        {
                           ?>
                                $('.popup-message').html('Please Fill Additional Questions');
                                $('#part1').css('display', 'none');
                                $('#part2').css('display', 'block');  
                                return false;
                           <?php  
                        }
                        else
                        {
                             ?>
                                $('.popup-message').html('Property Added Successfully...');
                                setTimeout(function () {  window.location.href = "<?php echo $base_url; ?>dashboard.php";}, 3000);                   
                                return false;
                             <?php 
                        }
                        
                        ?>
                    } else
                    {
                        $('.popup-header').html('NOTIFICATION');
                        $('.popup-message').html('Invalid Property Details');
                        return false;
                    }
                }
            });
            <?php
            }else
            {
                ?>
                    $('.popup-header').html('');
                    $('.popup-message').html('');
                    $.ajax({
                        type: "POST",
                        data: $('#form_list').serialize(),
                        url: "<?php echo $base_url; ?>question_process.php",
                        success: function (result) {
                            console.log(result);
                            $('.yello-menu').trigger('click');
                            if (result == 1)
                            {
                                $('.popup-header').html('NOTIFICATION');
                                <?php
                                if($counts_questions_part2>0)
                                {
                                   ?>
                                        $('.popup-message').html('Please Fill Additional Questions');
                                        $('#part1').css('display', 'none');
                                        $('#part2').css('display', 'block');  
                                        return false;
                                   <?php  
                                }
                                else
                                {
                                     ?>
                                        $('.popup-message').html('Please Sign In THE Website');
                                        setTimeout(function () {  window.location.href = "<?php echo $base_url; ?>signin.php";}, 3000);                   
                                        return false;
                                     <?php 
                                }

                                ?>
                            } else
                            {
                                $('.popup-header').html('NOTIFICATION');
                                $('.popup-message').html('Error Found, Try Again');
                                return false;
                            }

                        }
                    });     
                <?php       
            }        
        ?>
      return false;
    }
    
    /*step 1 process end here*/

    /*pop up message code here*/
    $('.yello-menu').click(function (e) {
        $('#target-id').callpopup('.close-it'); //$(YOUR POPUP ID).callpopup(CLOSE BUTTON ID);
    });

    $(document).ready(function (e) {
        $('#amazing-select-1').amazing_select();
        $('.radio-lable').each(function (index, element) {
            $(this).attr('name', $(this).children('input').attr('name'));
        });
    });
     $('.radio-lable').click(function (e) {
        var name = $(this).attr('name');
        $('.radio-lable').each(function (index, element) {
            if ($(this).attr('name') == name)
            {
                $(this).children('input').prop('checked', '');
                $(this).removeClass('active');
            }
        });
        $(this).addClass('active');
        $(this).children('input').prop('checked', 'checked');
    });
    /*pop up message code end here*/
</script>
