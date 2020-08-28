<script type="text/javascript">
	$(document).ready(function(){
/*============= fetching json format for read products =====================================*/
		$.ajax({
			url:'<?php echo APP_URI ?>/system/model/read.php',
			method:"POST",
			contentType:"application/json",
			success:function(result){
				$(".jsonFormat").append("<pre>"+result+"</pre>");
			}
		})
/*============= fetching json format for read products =====================================*/

/*============= fetching editable format for read products ==================================*/
		$.ajax({
			url:'<?php echo APP_URI ?>/system/model/readEditable.php',
			method:"POST",
			contentType:"application/json",
			success:function(result){
				$(".editableFormat").append(result);
			}
		})
/*============= fetching editable format for read products ==================================*/

/*============= showing editable format div only ============================================*/
		$(".showEditable").on("click", function(){
			$(".jsonFormat").hide();
			$(".showEditable").hide();
			$(".showJson").show();
			$(".editableFormat").show();
		});
/*============= showing editable format div only ============================================*/
/*============= showing json format div only ================================================*/
		$(".showJson").on("click", function(){
			$(".jsonFormat").show();
			$(".showEditable").show();
			$(".editableFormat").hide();
			$(".showJson").hide();
		});
/*============= showing json format div only ================================================*/
/*============= showing home div only ========================================================*/
		$(document).on("click", "#home", function(){
			$(".createProduct").hide();
			$("#categoryCreate").hide();
			$(".fireicediv").hide();
			$(".productDisplay").show();
			clearResponse();
		});
/*============= showing home div only ========================================================*/

/*============= showing fire ice div only ====================================================*/
		$(document).on("click", "#fire_ice", function(){
			$(".createProduct").hide();
			$("#categoryCreate").hide();
			$(".productDisplay").hide();
			$(".fireicediv").show();
			clearResponse();
		});
/*============= showing home div only ========================================================*/

/*============= showing create new book div only =============================================*/
		$(document).on("click", "#create_product", function(){
			$(".createProduct").show();
			$("#categoryCreate").hide();
			$(".productDisplay").hide();
			$(".fireicediv").hide();
			clearResponse();
		});
/*============= showing create new book div only =============================================*/
/*============= showing new search fire ice form =============================================*/
		$(".newSearch").on("click", function(){
			$(".searchFormdiv").show()
			$(".searchresult").hide();
		})
/*============= showing new search fire ice form =============================================*/
/*============= submitting new search fire ice form ==========================================*/
		$(document).on("submit", "#fireicesearch", function(e){
			e.preventDefault();
			var fireicesearch = $(this);
			var form_data2 = JSON.stringify(fireicesearch.serializeObject());
			$(".Loader").show();
			$.ajax({
				url:'<?php echo APP_URI ?>/system/model/request.php',
				method:"POST",
				contentType:"plain/text",
				data:form_data2,
				success:function(result){
					if(result != ""){
						$(".Loader").hide();
						$(".newSearch").show();
						$(".searchFormdiv").hide();
						$(".searchresult").show();
						$(".showsearchresult").html("<pre>"+result+"</pre>");
					}
					else{
						alert("Please enter a search");
					}
				}
			});
			return false;
		});
/*============= submitting new search fire ice form ==========================================*/
/*============= submitting new book create form form ==========================================*/
		$(document).on("submit", "#new_product", function(e){
			e.preventDefault();
			var new_product = $(this);
			var form_data = JSON.stringify(new_product.serializeObject());
			$(".Loader").show();
			$.ajax({
				url:'<?php echo APP_URI ?>/system/model/create_book.php',
				method:"POST",
				contentType:"application/json",
				data:form_data,
				success:function(result){
					$(".Loader").hide();
					$("#response").show();
					if(result == "Book Successfully Posted"){	
					$("#response").html("<div class='alert alert-success'>"+result.message+"</div>");
					$(".reset").val('');
					$(".showImage").attr("src", "");
					}
					else{
						$("#response").html("<div class='alert alert-danger'>"+result.message+"</div>");
					}
					
				}
			});
			return false;
		});
/*============= submitting new book create form form ==========================================*/
/*============= clearing response messages from server ========================================*/
		function clearResponse(){
			$("#response").hide();
			$("#response").html("");
		}
/*============= clearing response messages from server ========================================*/
/*============= serializing form content to json format before sending to server ==============*/
		$.fn.serializeObject = function(){
			var o = {};
			var a = this.serializeArray();
			$.each(a, function(){
				if(o[this.name] !== undefined){
					if(o[this.name].push){
						o[this.name] = [o[this.name]];
					}
					o[this.name].push(this.value || "");
				}
				else{
					o[this.name] = this.value || "";
				}
			});
			return o;
		}
/*============= serializing form content to json format before sending to server ==============*/
/*============= showing category form only  ===================================================*/
		$(document).on("click", "#category", function(){
			showCategoryPage();
		});
/*============= showing category form only  ===================================================*/
/*============= category div function =========================================================*/
		function showCategoryPage(){
			$(".createProduct").hide();
			$("#categoryCreate").show();
			$(".productDisplay").hide();
			$(".fireicediv").hide();
			clearResponse();
		}
/*============= category div function =========================================================*/
/*============= submitting book create category form form =====================================*/
		$(document).on("submit", "#product_category", function(e){
			e.preventDefault();
			var product_category = $(this);
			form_data = JSON.stringify(product_category.serializeObject());
			$(".Loader").show();
			$.ajax({
				url:'<?php echo APP_URI ?>/system/model/category.php',
				method:"POST",
				contentType:"application/json",
				data:form_data,
				success:function(result){
					$(".Loader").hide();
					$("#response").show();
					if(result.message == "Category Created"){	
					$("#response").html("<div class='alert alert-success'>"+result.message+"</div>");
					$("#product_category")[0].reset();
					}
					else{
						$("#response").html("<div class='alert alert-danger'>"+result.message+"</div>");
					}
				}
			});
			return false;
		});
/*============= submitting book create category form form =================================*/
/*============= getting category list =====================================================*/
		$.ajax({
			url:'<?php echo APP_URI ?>/system/model/get_category.php',
			contentType:"text",
			success:function(result){
				$(".Productcategory").html(result);
			}
		})
/*============= getting category list =====================================================*/
	});
</script>