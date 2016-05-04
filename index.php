<?php
  include 'init/db.php';

  if(CONNECTED){

  include 'init/user.php';

  $page;

  if($USER_DATA!=null){

    if($_SERVER['REQUEST_METHOD']=='POST'){

      if(isset($_POST['act'])){

        if($_POST['act']=='logout'){

          unset($_SESSION['user_id']);
          header("Location:?");

        }
      }
    }


    $page = 'profile';

    if(isset($_GET['page'])){

      if($_GET['page']=='profile'){

        $page = 'profile';

      }else if($_GET['page']=='questions'){

        $page = 'questions';

      }else if($_GET['page']=='ask'){
        $page = 'ask';
      }else if($_GET['page'] =='edit_profile'){
        $page = 'edit_profile';
      }else if($_GET['page']=='my_questions'){
        $page = 'my_questions';
      }else if($_GET['page'] == 'user_profile'){
        $page = 'user_profile';
      }else if($_GET['page'] == 'like_page'){
        $page = 'like_page';
      }
      else{

        $page = '404';

      }

    }

    if($USER_DATA->login=="admin"&&$USER_DATA->password=="qwerty"){

      $page = 'home';

      if(isset($_GET['page'])){
        if($_GET['page'] == 'home'){
          $page = 'home';
        }else if($_GET['page'] =='manage_answers'){
          $page = 'manage_answers';
        }else if($_GET['page'] == 'manage_questions'){
          $page = 'manage_questions';
        }else{
          $page = '404';
        }
      }




    }
      if ($_SERVER['REQUEST_METHOD']=='POST'){
          if(isset($_POST['act'])){
              if($_POST['act']=='ask_question'){

                      $question = $_POST['question'];
                      $sender_id = $_POST['sender_id'];
                      $anonim = $_POST['anonim'];
                       if(isset($anonim)){
                       $query = $connection->query("INSERT INTO questions(id,sender_id,question,post_date,active)
                        VALUES (NULL,29,\"".$question."\",sysdate(),1) ");
                        header("Location:?");
                      }else{
                        $query = $connection->query("INSERT INTO questions(id,sender_id,question,post_date,active)
     VALUES (NULL,\"".$sender_id."\",\"".$question."\",sysdate(),1) ");
                  header("Location:?");
                      }



              }else if($_POST['act'] == 'upload_photo'){

                $file = $_FILES['avatar']['name'];
                $id = $_POST['imageID'];
                echo $id;
                $temp_file = explode(".", $file);

                $new_file = rand(1,10000).$id.".".end($temp_file);
                $image_url= "images/".$new_file;
                $id = $id +1;
                move_uploaded_file($_FILES['avatar']['tmp_name'], 'images/'.$new_file);

                $sql_query = "INSERT INTO images(id,uid,image_url,active)
                  VALUES(NULL,\"".$_SESSION['user_id']."\",\"".$image_url."\",1)";

                  $connection->query($sql_query);
                  header("Location:?");

              }else if($_POST['act'] == 'change_photo'){
                 $file = $_FILES['avatar']['name'];
                $id = $_POST['imageID'];
                echo $id;
                $temp_file = explode(".", $file);

                $new_file = rand(1,10000).$id.".".end($temp_file);
                $image_url= "images/".$new_file;
                $id = $id +1;
                move_uploaded_file($_FILES['avatar']['tmp_name'], 'images/'.$new_file);

                  $query = $connection->query("UPDATE images SET image_url=\"".$image_url."\" WHERE id =".$_SESSION['image_id']."  ");
                  header("Location:?");

              }else if($_POST['act'] == 'edit_profile'){
                $login = $_POST['login'];
                $full_name = $_POST['full_name'];
                $age = $_POST['age'];
                $gender = $_POST['genderU'];

                $query = $connection->query("UPDATE users
      SET login =\"".$login."\", full_name = \"".$full_name."\", age = ".$age.", gender = \"".$gender."\"
        WHERE id = ".$_SESSION['user_id']." ");
              header("Location:?");
              }
          }
      }

  }else{

    if($_SERVER['REQUEST_METHOD']=='POST'){

      if(isset($_POST['act'])){

         // echo $_POST['act'];
            if($_POST['act']=='login'){
              $login = $_POST['login'];
              $password = $_POST['password'];

              $query = $connection->query("SELECT *FROM users
                          WHERE  login = \"".$login."\" AND password = \"".$password."\"   ");
              if($row = $query->fetch_object()){
                if($row->active == '1'){
                  $_SESSION['user_id'] = $row->id;
                  header("Location:?");
                }else{
                 //$_SESSION['user_id'] = $row->id;
                  $_SESSION['deleted_id'] =$row->id;

                  header("Location:?page=activate");
                }



              }
                }else if($_POST['act']=='to_register'){
                      $login = $_POST['login'];
                      $password = $_POST['password'];
                      $full_name = $_POST['full_name'];
                      $age = $_POST['age'];
                      $gender = $_POST['genderU'];

    $query = $connection->query("INSERT INTO users(id,login,full_name,age,gender,password,active)
     VALUES (NULL,\"".$login."\",\"".$full_name."\",".$age.", \"".$gender."\", \"".$password."\",1) ");
                 //   header("Location:questions.php");

                  header("Location:?");
                }

      }

    }

    $page = 'view_questions';

    if(isset($_GET['page'])){

      if($_GET['page']=='view_questions'){

        $page = 'view_questions';

      }else if($_GET['page']=='login_form'){

        $page = 'login_form';

      }else if($_GET['page']=='registration'){
        $page = 'registration';
      }else if($_GET['page'] == 'activate'){
        $page = 'activate';
      }

      else{

        $page = '404';

      }

    }


  }


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content=
    "text/html; charset=us-ascii" />
    <title>
      Life Questions
    </title>
    <link rel="stylesheet" type="text/css" href=
    "css/style.css" />
    <style type="text/css">
      p{
          border-style: groove;
          padding: 5px;
}
      b{
        font-size: 15px;
      }
    </style>
    <script type="text/javascript" src="jquery-1.11.3.min.js">


    </script>


    <script type="text/javascript">

    var tab = 2;

    function load_more(idshka){

      $.get("ajax_request.php",
      {
        act: "load",
        tabNum: tab,
        id: idshka,
        coeff: 3
      },
      function(data){
        $("#list_answers_"+idshka).html(data);
        tab++;
      }
        );

    }



   function remove_answer(idshka,qiu){
    $.post("ajax_request.php",
      {
        act:"remove_a",
        id: idshka,
      },
      function(data){

       load_more(qiu);
      });

   }

    function show_answers(idshka){
    // alert("#hiddenID");
        $.post("ajax_request.php",
          {
              act: "list_answers",
              id: idshka

          },
          function(data){
            $("#list_answers_"+idshka).html(data);
          });
    }

    function add_answer(idshka,responder_id){
    //alert(responder_id);
     $.post("ajax_request.php",
        {
          act: "add_answer",
          answer: $("#answer_"+idshka).val(),
          question_id: idshka,
          resp_id: responder_id,

        },

        function(data){
          load_more(idshka);
          $("#answer_"+idshka).val('');
      });
    }
     function activate_profile(idshka){
      //alert(idshka);
     $.post("ajax_request.php",
      {
        act: "activate_user",
        user_id: idshka,
      },
      function(data){
        window.location.replace("?page=profile");
      });
     }
      function deactivate_profile(idshka){


        if(confirm('Are you sure?')){
            $.post("ajax_request.php",

          {
            act: "delete_user",
            user_id: idshka,
          },
          function(data){
            window.location.replace("?");
          });

        }

      }

      function delete_answer_a(idshka){
        $.post("ajax_request.php",

          {
            act:"delete_a_admin",
            answer_id:idshka,
          },
          function(data){

          });
      }

       function delete_question_a(idshka){
         $.post("ajax_request.php",
        {
          act: "delete_q_admin",
          question_id: idshka,


        },

        function(data){
          //alert(data);
      });
      }

      function delete_question(idshka){
       // alert(idshka);

      $.post("ajax_request.php",
        {
          act: "delete_q",
          question_id: idshka,


        },

        function(data){
          list_questions();
      });
      }

      function list_questions(){
        $.post("ajax_request.php",
          {
              act: "list_questions",

          },
          function(data){
            $("#list_of_questions").html(data);

          });
      }

    </script>
  </head>
  <body onload = "list_questions()">
    <div id="head">
		  <div id="title">
					 Life Questions
			</div>
      <div id="menu">
          <ul>
        <?php
                    if($USER_DATA==null){
                  ?>
                    <li>
                        <a href="?page=login_form">Login</a>
                    </li>
                    <li>
                        <a href="?page=view_questions">All Questions</a>
                    </li>
                    <li>
                        <a href="?page=registration">Registration</a>
                    </li>

                    <?php
                      }else{
                        if($USER_DATA->login=="admin"&&$USER_DATA->password=="qwerty"){
                          ?>
                    <li>
                        <a href="?page=manage_questions">Questions</a>
                    </li>
                    <li>
                        <a href="?page=manage_answers">Answers</a>
                    </li>
                    <li>
                        <a href="?page=home">Home</a>
                    </li>
                   <li>



                    </li>
                          <?php

                        }else{
                    ?>
                    <li>
                        <a href="?page=profile">Profile</a>
                    </li>
                    <li>
                        <a href="?page=ask">Ask question</a>
                    </li>
                    <li>
                        <a href="?page=questions"> All Questions</a>
                    </li>
                    <li>
                        <a href="?page=my_questions"> My Questions</a>
                    </li>
                    <li>
                        <a href="?page=edit_profile">Edit Profile</a>
                    </li>
                   <li>



                    </li>
                    <?php

                      }
}
                    ?>
       </ul>
      </div>
    </div>
    <div id="body_wrapper">
      <div id="body">
        <div id="left">
          <div class="top"></div>
          <div class="content">


						<?php

          include 'views/'.($USER_DATA!=null?'logged':'notlogged').'/'.$page.'.php';

        ?>
		</div>
          <div class="bottom"></div>
        </div>
        <div id="right">
          <div class="top"></div>
          <div class="content">
            <h2>Statistics</h2>
            <ul>
            <?php
              $query = $connection->query("SELECT COUNT(id) AS qnum FROM questions where active = 1");

              while($row = $query->fetch_object()){
                ?>
             <li><b><i>Questions:</i><?php echo $row->qnum;?></b></li>

            <?php
          }
            $query1 = $connection->query("SELECT COUNT(id) AS anum FROM answers");
            while($row1 = $query1->fetch_object()){
            ?>
              <li><b><i>Answers:</i><?php echo $row1->anum;?></li>

                <?php

              }
            ?>


						</ul>
						<hr />
            <h4>Quote of day</h4>
						There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...<br />
						<hr />
            Moderator:<br>Badyrov Abdinur<br>
            <b> e-mail:</b><br><i>b.abdi@gmail.com</i>

                     </div>
          <div class="bottom"></div>
        </div>
        <div class="clearer"></div>
      </div>
      <div class="clearer"></div>
    </div>
    <div id="end_body"></div>
    <div id="footer">
      &copy; LIFE QUESTIONS, 2016
    </div>
  <!-- Designed by DreamTemplate. Please leave link unmodified. -->
<br><center></center>
</body>
</html>
<?php
  }
?>
