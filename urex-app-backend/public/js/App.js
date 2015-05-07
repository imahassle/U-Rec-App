//App.js
var app = (function() {

	var api = {
		views: {},
		models: {},
		collections: {},
		content: null,
		router: null,
		cms: null,
		viewsFactory: null,
		init: function() {
			this.content = $("#insert"); //Sets initial view for app
			if($.cookie('U-Rex-API-Key')) {
				ViewsFactory.menu();
				$("#userName").html($.cookie('First-Name'));
				$(".aug-top-bar").show();
			}

			// this.rentalInfo = new TempRentals();
			// this.rentalInfo.fetch();
			// this.rentalInfo.bind('reset', function() {console.log(this.rentalInfo);});
			$.ajaxSetup({
				headers: { 'X-Authorization' : $.cookie('U-Rex-API-Key')},
				error: function(jqXHR, textStatus, errorThrown) {
					checkError({message: errorThrown});
				},
			});

			Backbone.history.start();
			return this;
		},
		changeContent: function(el) {
			this.content.empty().append(el);
			return this;
		}
	};
	var ViewsFactory = {
		login: function() {
			if(!this.loginView) {
				this.loginView = new loginView({
					el: this.content
				});
			}
			return this.loginView;
		},
		menu: function() {
			console.log("Menu load?");
			if(!this.menuViews) {
				this.menuViews = new menuView({
					el: $("#menu"),
					permissions: "admin"
				});
			}
			return this.menuViews;
		},
		removeMenu: function() {
			console.log("removing menu...");
			$("#menu").html("");
			this.menuView = null;
			return this.menuView;
		},
		facilityHome: function() {
			this.facilityHomeView = new homeView({
				category: 1,
				sub: $("#facilityMenu"),
				name: "U-Rec",
				collectionName: "app.viewsFactory.facilityHomeView.collection"
			});
			return this.facilityHomeView;
		},
		facilityAnnouncements: function() {
			this.facilityAnnouncementsView = new announcementView({
				url: "api/announcement/category/1",
			});
			return this.facilityAnnouncementsView;
		},
		facilityHours: function() {
			if(!this.facilityHoursView) {
				this.facilityHoursView = new api.views.facilityHours({
					el: this.content
				});
			}
			return this.facilityHoursView;
		},
		facilityProg: function() {
			if(!this.facilityProgView) {
				this.facilityProgView = new api.views.facilityProg({
					el: this.content
				});
			}
			return this.facilityProgView;
		},
		facilityEvents: function() {
				this.facilityEventsView = new eventView({
					url: "api/event/category/1",
				});
			return this.facilityEventsView;
		},
		facilityPhotos: function() {
			this.facilityPhotosView = new imageView({
				category: 1,
				name: "U-Rec",
				collectionName: "app.viewsFactory.facilityPhotosView.collection"
			});
			return this.facilityPhotosView;
		},
		facilityFeedback: function() {
			if(!this.facilityFeedbackView) {
				this.facilityFeedbackView = new api.views.facilityFeedback({
					el: this.content
				});
			}
			return this.facilityFeedbackView;
		},
		outdoorrecHome: function() {
			this.outdoorrecHomeView = new homeView({
				category: 2,
				sub: $("#outdoorrecMenu"),
				name: "Outdoor Rec",
				collectionName: "app.viewsFactory.outdoorrecHomeView.collection"
			});
			return this.outdoorrecHomeView;
		},
		outdoorrecAnnouncements: function() {
			this.outdoorrecAnnouncementsView = new announcementView({
				url: "api/announcement/category/2",
			});
			return this.outdoorrecAnnouncementsView;
		},
		outdoorrecTrips: function() {
			this.outdoorrecTripsView = new eventView({
				url: "api/event/category/2",
			});
			return this.outdoorrecTripsView;
		},
		outdoorrecPhotos: function() {
				this.outdoorrecPhotosView = new imageView({
					url: "api/image/category/2",
				});
			return this.outdoorrecPhotosView;
		},
		intramuralsHome: function() {
			this.intramuralsHomeView = new homeView({
				category: 3,
				sub: $("#intramuralsMenu"),
				name: "Intramurals",
				collectionName: "app.viewsFactory.intramuralsHomeView.collection"
			});
			return this.intramuralsHomeView;
		},
		intramuralsAnnouncements: function() {
			this.intramuralsAnnouncementsView = new announcementView({
				url: "api/announcement/category/3",
			});
			return this.intramuralsAnnouncementsView;
		},
		intramuralsPhotos: function() {
				this.intramuralsPhotosView = new imageView({
					url: "api/image/category/3",
				});
			return this.intramuralsPhotosView;
		},
		climbingwallHome: function() {
				this.climbingwallHomeView = new homeView({
					category: 4,
					sub: $("#climbingwallMenu"),
					name: "Climbing Wall",
					collectionName: "app.viewsFactory.climbingwallHomeView.collection"
				});
			return this.climbingwallHomeView;
		},
		climbingwallAnnouncements: function() {
				this.climbingwallAnnouncementsView = new announcementView({
					url: "api/announcement/category/4",
				});
			return this.climbingwallAnnouncementsView;
		},
		climbingwallHours: function() {
			if(!this.climbingwallHoursView) {
				this.climbingwallHoursView = new api.views.climbingwallHours({
				});
			}
			return this.climbingwallHoursView;
		},
		climbingwallPhotos: function() {
				this.climbingwallPhotosView = new imageView({
					url: "api/image/category/4",
				});
			return this.climbingwallPhotosView;
		},
		climbingwallEvents: function() {
			this.climbingwallEventsView = new eventView({
				url: "api/event/category/4",
			});
			return this.climbingwallEventsView;
		},
		stats: function() {
			if(!this.statsView) {
				this.statsView = new api.views.stats({
					el: this.content
				});
			}
			return this.statsView;
		},
		rentals: function() {
			if(!this.rentalsView) {
				this.rentalsView = new api.views.rentals({
					collection: api.rentalInfo
				});
			}
			return this.rentalsView;
		}
	};

	api.viewsFactory = ViewsFactory;

	// api.facilityView = ViewsFactory.facilityHome();

	var Router = Backbone.Router.extend({
		routes: {
			"facility": "facilityHome",
			"facility/hours": "facilityHours",
			"facility/programs": "facilityProg",
			"facility/programs/remove/:id": "facilityRemoveProg",
			"facility/events": "facilityEvents",
			"facility/photos": "facilityPhotos",
			"facility/feedback": "facilityFeedback",
			"facility/remove/:id": "facilityRemove",
			"outdoorrec": "outdoorrecHome",
			"outdoorrec/trips": "outdoorrecTrips",
			"outdoorrec/photos": "outdoorrecPhotos",
			"outdoorrec/remove/:id": "outdoorrecRemove",
			"intramurals": "intramuralsHome",
			"intramurals/photos": "intramuralsPhotos",
			"climbingwall": "climbingwallHome",
			"climbingwall/hours": "climbingwallHours",
			"climbingwall/photos": "climbingwallPhotos",
			"climbingwall/events": "climbingwallEvents",
			"rentals": "rentals",
			"stats": "stats",
			"": "home",
			"login": "login"
		},
		home: function() {
			api.changeContent(ViewsFactory.login().$el);
		},
		facilityHome: function() {
			api.changeContent(ViewsFactory.facilityHome().$el);
		},
		facilityHours: function() {
			// alert("Hit about");
			api.changeContent(ViewsFactory.facilityHours().$el);
			// ViewsFactory.about.render();
		},
		facilityProg: function() {
			api.changeContent(ViewsFactory.facilityProg().$el);
		},
		facilityEvents: function() {
			api.changeContent(ViewsFactory.facilityEvents().$el);
		},
		facilityPhotos: function() {
			api.changeContent(ViewsFactory.facilityPhotos().$el);
		},
		facilityFeedback: function() {
			api.changeContent(ViewsFactory.facilityFeedback().$el);
		},
		outdoorrecHome: function() {
			api.changeContent(ViewsFactory.outdoorrecHome().$el);
		},
		outdoorrecTrips: function() {
			api.changeContent(ViewsFactory.outdoorrecTrips().$el);
		},
		outdoorrecPhotos: function() {
			api.changeContent(ViewsFactory.outdoorrecPhotos().$el);
		},
		intramuralsHome: function() {
			api.changeContent(ViewsFactory.intramuralsHome().$el);
		},
		intramuralsPhotos: function() {
			api.changeContent(ViewsFactory.intramuralsPhotos().$el);
		},
		climbingwallHome: function() {
			api.changeContent(ViewsFactory.climbingwallHome().$el);
		},
		climbingwallHours: function() {
			api.changeContent(ViewsFactory.climbingwallHours().$el);
		},
		climbingwallPhotos: function() {
			api.changeContent(ViewsFactory.climbingwallPhotos().$el);
		},
		climbingwallEvents: function() {
			api.changeContent(ViewsFactory.climbingwallEvents().$el);
		},
		rentals: function() {
			api.changeContent(ViewsFactory.rentals().$el);
			// api.rentalInfo.fetch({reset: "true"});
		},
		stats: function() {},
		login: function() {
			api.changeContent(ViewsFactory.login().$el);
		},
	});
	api.router = new Router();

	return api;

})();
