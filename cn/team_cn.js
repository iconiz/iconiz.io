$(function() {
    $.blockUI({
        message: '<h1>资料正在加载，请等待..</h1>'
      });
    $.ajax({
	url:"http://srv.iconiz.io/api/services/app/IconizTeamMember/GetAll",
	type:'GET',
	dataType:'json',
	success : function(json) {
        $.unblockUI();
					$.each(json.result, function(i, item) {
						var teammember = $("#teammember");
						var pre = 
						"<div class='col-md-4 col-sm-6 c-margin-b-30'>"+
							"<div class='c-content-person-1 c-option-2'>"+
								"<div class='c-caption c-content-overlay placeholder'>"+
									"<div class='c-overlay-wrapper'>"+
										"<div class='c-overlay-content'>"+
											"<a href='javascript:;' data-toggle='modal' data-target='#modal"+i+"'>"+
												"<i class='icon-magnifier'></i>"+
											"</a>"+
										"</div>"+
									"</div>"+
									"<div id='modal"+i+"' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>"+
										"<div class='modal-dialog'>"+
											"<div class='modal-content c-square'>"+
												"<div class='modal-header'>"+
													"<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
														"<span aria-hidden='true'>×</span>"+
													"</button>"+
													"<h4 class='modal-title' id='myModalLabel'>"+item.name_Chn+"</h4>"+
												"</div>"+
												"<div class='modal-body'>"+
													"<p>"+
														item.description_Chn +
													"</p>"+
												"</div>"+
												"<div class='modal-footer'>"+
													"<button type='button' class='btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase' data-dismiss='modal'>Close</button>"+
												"</div>"+
											"</div>"+
										"</div>"+
									"</div>"+
									"<img class='c-overlay-object img-responsive' id='memberpic"+i+"' alt='"+item.name_Chn+"'>"+
								"</div>"+
								"<div class='c-body'>"+
									"<div class='c-head clearfix'>"+
										"<div class='c-name c-font-uppercase c-font-bold'>"+item.name_Chn+"</div>";
										var linkedin = "";
										if(item.linkedIn) 
										linkedin = "<ul class='c-socials c-theme-ul'>"+
											"<li>"+
												"<a href='"+item.linkedIn+"'>"+
													"<i class='fa fa-linkedin'></i>"+
												"</a>"+
											"</li>"+
										"</ul>";
									var pos = 
									"</div>"+
									"<div class='c-position'>"+
										item.title_Chn+
									"</div>"+
								"</div>"+
							"</div>"+
						"</div>";
					teammember.append(pre+linkedin+pos);
					$.ajax({
						url:"http://srv.iconiz.io/api/services/app/Profile/GetProfilePictureById?profilePictureId=" + item.profilePictureId,
						type:'GET',
						dataType:'json',
						success : function(json) {
							$("#memberpic"+i).attr("src",'data:image/jpeg;base64,' + json.result.profilePicture);
						}});
					});
				},
	error:function(){
        $.unblockUI();
		swal("Oops!", "something wrong while getting team members!", "error")
	}
});
})