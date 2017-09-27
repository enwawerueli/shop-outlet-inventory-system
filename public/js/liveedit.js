$(document).ready(function(){

	function updateHtml(args){
		args.container.hide().html(args.html).slideDown(function(){
			if(typeof args.complete === 'function'){
				args.complete();
			}
		});
	}

	function submitForm(form, args){
		$.ajax({
			url: form.attr('action'),
			type: 'post',
			dataType: 'html',
			data: form.serialize(),
		})
		.done(function(data, status, req) {
			if(typeof args === 'object') args.html = data;
			updateHtml(args);
			// console.log(data);
		})
		.fail(function(req, status, error) {
			console.log(status);
		});
	}

	$(document).on('change', '#filter', function(e){
		var url = $(this).parents('form').attr('action') + '/' + $(this).val();
		var args = {
			container: $('.cc-tab'),
			complete: function(){
				$('.cc-navbar').slideUp();
				$('.cc-alert').fadeIn();
			}
		}
		$.get(url, function(data, status, req){
			args.html = data;
			updateHtml(args);
		});
		return false;
	});

	$(document).on('submit', '.cc-tab form', function(e){
		var args = {
			container: $('.cc-tab'),
			complete: function(){
				$('.cc-navbar').slideUp();
				$('.cc-alert').fadeIn();
			}
		}
		submitForm($(this), args);
		return false;
	});

	$(document).on('click', '.cc-nav-link, #cc-brand, a.cc-product-details', function(e){
		var url = $(this).attr('href');
		var args = {
			container: $('.cc-tab'),
			complete: function(){
				$('.cc-navbar').slideUp();
				$('.cc-alert').fadeIn();
			}
		}
		$.get(url, function(data, status, req){
			args.html = data;
			updateHtml(args);
		});
		return false;
	});

	$(document).on('click', '.cc-nav-toggle', function(e){
		$('.cc-navbar').slideToggle();
		return false;
	});

	$(document).on('click', '.cc-dismiss', function(e){
		$(this).parents('div.alert').fadeOut();
		return false;
	});
});
