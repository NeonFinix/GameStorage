<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
include("session.php");
?>

<!DOCTYPE html>
<!--
Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
-->
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<link type="text/css" href="../Assets/Templates/Blog/Sample/css/sample.css" rel="stylesheet" media="screen" />
	<title>Write Blog</title>
	<style>
		h2 {
			color: black !important;
		}

		h3 {
			color: black !important;
		}

		h4 {
			color: black !important;
		}

		p {
			color: black !important;
		}
	</style>
</head>

<body >



	<main  style="height: 100vh;">

		<div class="centered">
			<div style="color:White ; font-size: 20px; padding-top: 60px;">Title
				<input type="text" id="title"
					style="width: 800px; height: 40px; border-radius: 10px;margin-top: 20px;margin-bottom: 30px; color: black;" required="required" />
			</div>
			<div id="editor">

			</div>


		</div>
		<div style="width:100%;display: flex; justify-content: flex-end;">
			<button
				style="width: 200px;height: 40px; background-color: blue; border: none;border-radius: 10px; color: white; margin-right: 50px; "
				onclick="InputBlog()">SUBMIT</button>

		</div>
	</main>



	<script src="../Assets/Templates/Blog/ckeditor.js"></script>
	<script src="../Assets/JQuery/jQuery.js"></script>


	<script>
		ClassicEditor
			.create(document.querySelector('#editor'), {
				// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]

				toolbar: {
					items: [
						'undo', 'redo',
						'|', 'heading',
						'|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
						'|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
						'|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
					],
					shouldNotGroupWhenFull: false
				}
			})
			.then(editor => {
				window.editor = editor;
			})
			.catch(err => {
				console.error(err.stack);
			});
		function InputBlog() {
			const editorData = window.editor.getData();
			const title = document.getElementById('title').value;

			$.ajax({
				url: "../Assets/AjaxPages/AjaxBlogDev.php",
				method: "POST",
				data: { blogData: editorData, title: title },
				success: function (data) {
					// $('#review_modal').modal('hide');

					// load_rating_data();
					//$("#review_content").html(data);
					alert(data);
				}
			})
			console.log(editorData);
		}

	</script>
	

</body>


</html>



<!-- jquery plugins here-->
<script src="../Assets/Templates/Main/js/jquery-1.12.1.min.js"></script>
<!-- popper js -->
<script src="../Assets/Templates/Main/js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="../Assets/Templates/Main/js/bootstrap.min.js"></script>
<!-- easing js -->
<script src="../Assets/Templates/Main/js/jquery.magnific-popup.js"></script>
<!-- swiper js -->
<script src="../Assets/Templates/Main/js/swiper.min.js"></script>
<!-- swiper js -->
<script src="../Assets/Templates/Main/js/masonry.pkgd.js"></script>
<!-- particles js -->
<script src="../Assets/Templates/Main/js/owl.carousel.min.js"></script>
<!-- <script src="../Assets/Templates/Main/js/jquery.nice-select.min.js"></script> -->
<!-- slick js -->
<script src="../Assets/Templates/Main/js/slick.min.js"></script>
<script src="../Assets/Templates/Main/js/jquery.counterup.min.js"></script>
<script src="../Assets/Templates/Main/js/waypoints.min.js"></script>
<script src="../Assets/Templates/Main/js/contact.js"></script>
<script src="../Assets/Templates/Main/js/jquery.ajaxchimp.min.js"></script>
<script src="../Assets/Templates/Main/js/jquery.form.js"></script>
<script src="../Assets/Templates/Main/js/jquery.validate.min.js"></script>
<script src="../Assets/Templates/Main/js/mail-script.js"></script>
<!-- custom js -->
<script src="../Assets/Templates/Main/js/custom.js"></script>