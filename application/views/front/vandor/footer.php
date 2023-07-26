
<style>
    table#example p {
    width: 100%;
    white-space: break-spaces;
}



.cross_img {
	    width: 80px;
	    height: 80px;
	    margin-top: 8px;
	}
	.cross_image {
	    margin-top: 8px;
	    position: absolute;
	    border: 1px solid #FFF;
	    width: 25px;
	    text-align: center;
	    border-radius: 100px;
	    height: 25px;
	    line-height: 25px;
	    font-weight: bold;
	    background: #333333bf;
	    color: #FFFF;
	}
	.chosen-container-multi .chosen-choices{
		background: none!important;
	}
	/*input[type=file]{
	     
	    color:transparent;
	}*/

</style>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

$('#button').click(function () {
    $("input[type='file']").trigger('click');
})

$("input[type='file']").change(function () {
    $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''))
})

$('.onlyInteger').on('keypress', function(e) {

	      keys = ['0','1','2','3','4','5','6','7','8','9','.']

	      return keys.indexOf(event.key) > -1

	    }) 

</script>