//App.js
var app = (function() {

	var api = {
		views: {},
		models: {},
		collections: {},
		content: null,
		router: null,
		cms: null,
		init: function() {
			this.content = $("#main");
			ViewsFactory.menu();
			//
			Backbone.history.start();
			return this;
		},
		changeContent: function(el) {
			this.content.empty().append(el);
			return this;
		}
	};
	var ViewsFactory = {
		menu: function() {
			if(!this.menuView) {
				this.menuView = new api.views.menu({ 
					el: $("#menu") 
				});
			}
			return this.menuView;
		},
		about: function() {
			if(!this.aboutView) {
				this.aboutView = new api.views.about({ 
					el: this.content
				});
			}
			return this.aboutView;
		}
	};
	var Router = Backbone.Router.extend({
		routes: {
			"about": "about",
			"services": "services",
			"contacts": "contacts",
			"": "home"
		},
		home: function() {
			// var view = ViewsFactory.list();
			// api.changeContent($el);
		},
		about: function() {
			// alert("Hit about");
			api.changeContent(ViewsFactory.about().$el);
			// ViewsFactory.about.render();
		},
		services: function() {},
		contacts: function() {}
	});
	api.router = new Router();

	return api;

})();