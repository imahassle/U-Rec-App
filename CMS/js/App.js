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
			this.content = $("#main"); //Sets initial view for app
			ViewsFactory.menu();
			ViewsFactory.cms();
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
		cms: function() {
			if(!this.cmsView) {
				this.cmsView = new api.views.cms({ 
					el: this.content
				});
			}
			return this.cmsView;
		},
		about: function() {
			if(!this.aboutView) {
				this.aboutView = new api.views.about({ 
					el: this.content
				});
			}
			return this.aboutView;
		},
		login: function() {
			if(!this.loginView) {
				this.loginView = new api.views.login({ 
					el: this.content
				});
			}
			return this.loginView;
		},
		stats: function() {
			if(!this.statsView) {
				this.statsView = new api.views.stats({ 
					el: this.content
				});
			}
			return this.statsView;
		}
	};
	var Router = Backbone.Router.extend({
		routes: {
			"about": "about",
			"services": "services",
			"contacts": "contacts",
			"": "home",
			"login": "login"
		},
		home: function() {
			api.changeContent(ViewsFactory.cms().$el);
		},
		about: function() {
			// alert("Hit about");
			api.changeContent(ViewsFactory.about().$el);
			// ViewsFactory.about.render();
		},
		services: function() {},
		contacts: function() {},
		login: function(valid) {
			api.changeContent(ViewsFactory.login().verify(valid).$el);
		}
	});
	api.router = new Router();

	return api;

})();