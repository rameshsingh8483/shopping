<style>

/* autocomplete */


/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  /* display: inline-block; */
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}


.autocomplete-items div {

  padding: 10px;
  cursor: pointer;
  color: black;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #D85E29;
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color:  #D85E29 !important;
  color: #fff !important;
}
</style>

<!-- Header Container  -->
<header id="header" class=" typeheader-4">

<!-- Header Top -->
<div class="header-top hidden-compact">
<div class="container">
<div class="row">
<div class="header-top-left col-lg-6 col-md-4 col-sm-6 col-xs-7">
</div>

<div class="header-top-right collapsed-block col-lg-6 col-md-8 col-sm-6 col-xs-5">
<ul class="top-link list-inline">
				<?php if(!isset($_SESSION['user_id'])){ ?>
				<li class="account hidden-lg hidden-md hidden-sm" id="my_account">
                            <a href="#" title="My Account " class="btn-xs dropdown-toggle" data-toggle="dropdown"> <span>My Account </span>  <span class="fa fa-caret-down"></span>
                            </a>
                            <ul class="dropdown-menu " style="display: none;">
                                <li><a href="register.html">Register</a>
                                </li>
                                <li><a href="login.html">Login</a>
                                </li>
                            </ul>
                        </li>

<li class="account  hidden-xs" id="my_account">
<a href="register.php" title="My Account " class="btn-xs"> <span> Register</span>
</a>
</li>
<li class="hidden-xs"><a href="login.php"><i class="fa fa-lock"></i>Login</a>
</li>
				<?php }
				else{
					?>

				<li class="hidden-xs"><a href="logout.php"><i class="fa fa-lock"></i>Logout</a>
				</li>

				<?php } ?>
</ul>
</div>
</div>
</div>
</div>

<!-- //Header Top -->

<!-- Header center -->
<div class="header-middle">
<div class="container">
<div class="row">
<!-- Logo -->
<div class="navbar-logo col-lg-2 col-md-3 col-sm-12 col-xs-12">
<div class="logo"><a href="index.php"><img src="assets/image/catalog/logo4.png" title="Your Store" alt="Your Store" /></a></div>
</div>
<!-- //end Logo -->
<!-- Search -->
<div class="middle2 col-lg-7 col-md-6">
<div class="search-header-w">
<div class="icon-search hidden-lg hidden-md hidden-sm"><i class="fa fa-search"></i></div>
<div id="sosearchpro" class="sosearchpro-wrapper so-search ">
<form method="POST" action="products.php" autocomplete="off">
<div id="search0" class="search input-group form-group ajax-search">
<div class="select_category filter_type  icon-select hidden-sm hidden-xs">
<select class="no-border" id="live-search" name="category_id">
<option value="">All Categories</option>
<?php
$sql = $conn->query("SELECT * FROM cat_detail order by cat_name")or die($conn->error);
while($row = $sql->fetch_assoc()){
?>
<option value="<?php echo $row['cat_id']?>"><?php echo $row['cat_name']?></option>
<?php
}
?>
</select>
</div>
<div class="search-box autocomplete">
	<!-- <input class="autosearch-input form-control" type="text" id="search"  placeholder="Keyword here..." name="search"> -->
<input class="autosearch-input form-control" type="text"id="myInput1" autocomplete="off"  placeholder="Keyword here..." name="search">
        <!-- <div class="result search-data"></div> -->
    </div>
   <!-- Suggestions will be displayed in below div. -->
   <span class="input-group-btn">
<button type="submit" class="button-search btn btn-primary" name="submit_search"><i class="fa fa-search"></i></button>
</span>
</div>
<input type="hidden" name="route" value="product/search" />
</form>
</div>
</div>
</div>
<!-- //end Search -->

<div class="middle3 col-lg-3 col-md-3">
<!--cart-->
<div class="shopping_cart">
<div id="cart" class="btn-shopping-cart">

<a data-loading-text="Loading... " class="btn-group top_cart" href="cart.php">
<div class="shopcart">
<span class="icon-c">
<i class="fa fa-shopping-bag"></i>
</span>
<div class="shopcart-inner">
<p class="text-shopping-cart">
My cart
</p>
<?php
$count = 0;

if(isset($_SESSION['user_id'])){
 $find = $conn->query("SELECT * FROM cart_detail WHERE cart_user_id = '".decr($_SESSION['user_id'])."'")or die($conn->error);

$count = $find->num_rows;
}
?>
<span class="total-shopping-cart cart-total-full">
<span class="items_cart"><?php echo $count;?></span><span class="items_cart2"> item(s)</span>
</span>
</div>
</div>
</a>

</div>

</div>
<!--//cart-->
</div>
</div>

</div>
</div>
<!-- //Header center -->

<!-- Header Bottom -->
<div class="header-bottom hidden-compact">
<div class="container">
<div class="row">

<div class="bottom1 menu-vertical col-lg-2 col-md-3">
<!-- Secondary menu -->
<div class="responsive so-megamenu  megamenu-style-dev">
<div class="so-vertical-menu ">
<nav class="navbar-default">

<div class="container-megamenu vertical">
<div id="menuHeading">
<div class="megamenuToogle-wrapper">
<div class="megamenuToogle-pattern">
<div class="container">
<div>
<span></span>
<span></span>
<span></span>
</div>
All Categories
</div>
</div>
</div>
</div>
<div class="navbar-header">
<button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">
<i class="fa fa-bars"></i>
<span>  All Categories     </span>
</button>
</div>
<div class="vertical-wrapper">
<span id="remove-verticalmenu" class="fa fa-times"></span>
<div class="megamenu-pattern">
<div class="container-mega">
<ul class="megamenu">
<?php

$cat = "cat";
$subcat = "subcat";

$sql = $conn->query("SELECT * FROM cat_detail")or die($conn->error);
while($row = $sql->fetch_assoc()){
?>
<li class="item-vertical css-menu with-sub-menu hover">
<p class="close-menu"></p>
<?php
echo "<a href='products.php?block=".encr($row['cat_id'])."&block1=".$cat."' class='clearfix'><span>".$row['cat_name']."</span><b class='caret'></b>
</a>";
				$sql2 = $conn->query("SELECT * FROM subcat_detail
				WHERE subcat_cat_id = '{$row['cat_id']}'")or die($conn->error);

				if( $sql2->num_rows !=0  ){
				?>
			<div class="sub-menu" data-subwidth="20">
			<div class="content" >
			<div class="row">
			<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-12 hover-menu">
					<div class="menu">
						<ul>
							<?php
							while( $row1 =$sql2-> fetch_assoc()){

							?>

				<li>
					<?php echo "<a href='products.php?block=".encr($row1['subcat_id'])."&block1=".$subcat."' class='clearfix'>
					<span>".$row1['subcat_name']."</span>
					</a>";
				?>
				</li>
				<?php

							}
				?>
			</ul>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>

		<?php
				}
		?>

</li>
<?php
}
?>
</ul>
</div>
</div>
</div>
</div>
</nav>
</div>
</div>
<!-- // end Secondary menu -->
</div>
<!-- Main menu -->
<div class="main-menu col-lg-10 col-md-9">
<div class="responsive so-megamenu megamenu-style-dev">
<nav class="navbar-default">
<div class=" container-megamenu  horizontal open ">
<div class="navbar-header">
<button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>

<div class="megamenu-wrapper">
<span id="remove-megamenu" class="fa fa-times"></span>
<div class="megamenu-pattern">
<div class="container-mega">
<ul class="megamenu" data-transition="slide" data-animationtime="250">
<li class="home hover">
<a href="index.php">Home</a>

</li>
<li class="">
<p class="close-menu"></p>
<a href="about.php" class="clearfix">
<strong>About</strong>
<span class="label"></span>
</a>
</li>
<li class="">
<p class="close-menu"></p>
<a href="contact.php" class="clearfix">
<strong>Contact</strong>
<span class="label"></span>
</a>
</li>


</ul>

</div>
</div>
</div>
</div>
</nav>
</div>
</div>
<!-- //end Main menu -->
</div>
</div>

</div>


<script>

var result = new Array();

var skills = new Array();

$(document).ready(function(){

  $.ajax({
     type:'get',
     url: 'process/ajax2.php',
     success: function(resp) {

       result = resp.skills;

       skills.push(result.vpro_name);



      //  $.each(result, function(i) {
      //
      //    skills.push(result.vpro_name);
      //
      //
      //
      // });

    },dataType : "json",

    });

    console.log(skills);

        });





function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
       // if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
  if ((arr[i].toUpperCase()).indexOf(val.toUpperCase()) != -1) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
        //   b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
              b.innerHTML =  arr[i].substr(0, val.length) ;
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;

        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput1"), skills);

</script>

<script type="text/javascript">
$(document).ready(function(){

    $('.search-box input[type="text"]').on("keyup input", function(){
			var test = $('#live-search').children("option:selected").val();
	//alert(test);
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
			    $.ajax({
               async: false,
			   	 			type: "POST",
               url: "ajax.php",
               data: {
                   //Assigning value of "name" into "search" variable.
                   term: inputVal,
				   cat: test

               },
               //If result found, this funtion will be called.
               success: function(data) {

					$(".result").html(data);
               }
           });

        } else{
            resultDropdown.empty();
        }
    });

    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
<!-- //Header Container  -->
</header>
