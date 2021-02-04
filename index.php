<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<style>
.box-title{
          border-radius: 5px;
			box-shadow: 0px 0px 3px 1px gray;
			padding: 10px 0px;

}
.form-group small {
  color:#e74c3c;
  position:absolute;
  bottom:0;
  left:0;
  visibility: hidden ;
}
.form-group.error small{
  visibility:visible;
}
</style>

<body>
		<div class="container">
			<div class="row m-3 text-center">
				<div class="col-lg-12">
					<h1 class="box-title">Ajax Insert || Update || Delete</h1>
				</div>
			</div>

            <div class="m-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> Add record</button>
            </div>
             <div id="records_content">
             </div>
         <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" >Add New Record</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
           <form action="#" id="form">
            <div class="form-group">
               <label for="username">Firstname</label>
               <input type="text" class="form-control"  id ="firstname" name="username"  placeholder="Enter firstname" >
               <small>Error message</small>
            </div>
            <div class="form-group">
               <label for="lastname">Lastname</label>
               <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Lastname">
            </div>
            <div class="form-group">
               <label for="email">Email</label>
               <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email id">
            </div>
            <div class="form-group">
               <label for="mobile">Mobile</label>
               <input type="text" class="form-control" id="mobile"  name="mobile" placeholder="Enter Mobile Number">
            </div>
           </form>


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-info" data-dismiss="modal" onclick = "addrecord()">AddRecord</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="update_user_model">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" >Add New Record</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
            <div class="form-group">
               <label for="update_firstname">Update_Firstname</label>
               <input type="text" class="form-control"  id ="update_firstname" placeholder="Enter firstname" required/>
               <small>Error mesaage<small>

            </div>
            <div class="form-group">
               <label for ="update_lastname">Update_Lastname</label>
               <input type="text" class="form-control" id="update_lastname" placeholder="Enter Lastname" required/>
            </div>
            <div class="form-group">
               <label for="update_email">Update_email</label>
               <input type="text" class="form-control" id="update_email" placeholder="Enter Email id" required/>
            </div>
            <div class="form-group">
               <label for="update_mobile">Update_Mobile</label>
               <input type="text" class="form-control" id="update_mobile" placeholder="Enter Mobile Number" required/>
            </div>



      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-info" data-dismiss="modal" onclick = "updateuserdetail()">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" name="" id="hidden_user_id">
      </div>

    </div>
  </div>
</div>


        </div>


        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   <script>
  $(document).ready(function (){
        readRecords(); 
    });

     function readRecords(){
         var readrecord = "readrecord";

         $.ajax({
            url:"backend.php",
            type:"post",
            data:{readrecord:readrecord},
            success:function(data, status){
                $('#records_content').html(data);
            }

         });
     }


         function  addrecord(){

var firstname = $('#firstname').val();
var lastname = $('#lastname').val();
var email = $('#email').val();
var mobile = $('#mobile').val();


$.ajax({
    url:"backend.php",
    type:"post",
    data:{ firstname:firstname,
           lastname:lastname,
           email : email,
           mobile: mobile,
    },

    success:function(data,status){
        readRecords();
    }
});
 }


   
    ////Delete record call 
     function DeleteUser(deleteid){
         var conf = confirm("Are you sure");
         if(conf == true){
             $.ajax({
               url:"backend.php",
               type:"post",
               data:{deleteid:deleteid},
               success:function(data,status){
                readRecords();  
               }
             });
         }
     }
    
    ////Update Record

    function GetUserDetails(id){
        $('#hidden_user_id').val(id);
        
        $.post("backend.php",{
            id:id
        }, function(data,status){
            var user = JSON.parse(data);
            $('#update_firstname').val(user.firstname);
            $('#update_lastname').val(user.lastname);
            $('#update_email').val(user.email);
            $('#update_mobile').val(user.mobile);

        }
        );
        $('#update_user_model').modal("show");
    }
  
////////update insert record\
function  updateuserdetail(){
  var firstnameupd = $('#update_firstname').val();         
  var lastnameupd = $('#update_lastname').val();
  var emailupd = $('#update_email').val();
  var mobileupd = $('#update_mobile').val();

   var hidden_user_idupd =  $('#hidden_user_id').val();
   
   $.post("backend.php",{
    hidden_user_idupd:hidden_user_idupd,
    firstnameupd:firstnameupd,
    lastnameupd:lastnameupd,
    emailupd:emailupd,
    mobileupd:mobileupd,
   },
   function(data,status){
    $('#update_user_model').modal("hide");
    readRecords();
   }   
   );
}

const form = document.getElementById('form');
const username = document.getElementById('firstname');
  

  form.addEventListener('submit',(event) =>{
    event.preventDefault();
    validation();
  });
  const validation = () =>{
    const username = firstname.value.trim();

     if(username == ""){
       setErrorMsg(username,"Firstname cannot be blank");
     }else if(username.length <=2){
      setErrorMsg(username,"Minimun 3 character");
     }else{
      setErrorMsg(username,"Minimun 3 character");
     }
  }

  function setErrorMsg(input,errormsgs){
    const formgroup = input.parentElement;
    const small = formgroup.querySelector('small');
    formgroup.className = "form-group error";
    small.innerText = errormsgs;
      
  }

    </script>





</body>
</html>