var AppRouter = Backbone.Router.extend({
    routes: {
        "*page": function(page){
			if (typeof page == 'null') return;
			$.ajax({
				url:window.location.pathname+page,
				dataType:"json",
				success: function(data)
				{
					var template_name = this.page.replace(/\//g,"_");
					var template = $(template_name).html();
					if (template == null || typeof template == 'undefined') {console.log("template not found. "+template_name); return;}

					$('#main_content').html(
						_.template(template,data)
					);
				}.apply({"page":page})
			})
        }

    }
});
// Initiate the router
var app_router = new AppRouter;


// Start Backbone history a necessary step for bookmarkable URL's
Backbone.history.start();

app_router.navigate("/home/", {trigger: true});