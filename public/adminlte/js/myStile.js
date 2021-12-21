$(document).ready(function() {
      $(".sidebar-menu a").on("click", function(){
      	//alert('ACT');
      $(this).find(".active").removeClass("active");
      $(this).parent("li").addClass("active");
   });
});