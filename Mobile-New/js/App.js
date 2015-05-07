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
			Backbone.history.start();
			return this;
		},
		changeContent: function(el) {
			this.content.empty().append(el);
			return this;
		}
	};
	var ViewsFactory = {
		main: function() {
			return $("#main").html();
		},
		facilityHome: function() {
			this.facilityHomeView = new homeView({
				url: "../urex-app-backend/public/api/hour/category/1",
				sub: $("#facilityMenu"),
				name: "U-Rec"
			});
			return this.facilityHomeView;
		},
		facilityAnnouncements: function() {
			this.facilityAnnouncementsView = new announcementView({
				url: "../urex-app-backend/public/api/announcement/category/1",
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
					url: "../urex-app-backend/public/api/event/category/1",
				});
			return this.facilityEventsView;
		},
		facilityPhotos: function() {
			this.facilityPhotosView = new imageView({
				url: "../urex-app-backend/public/api/image/category/1",
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
				url: "../urex-app-backend/public/api/hour/category/2",
				sub: $("#outdoorrecMenu"),
				name: "Outdoor Rec"
			});
			return this.outdoorrecHomeView;
		},
		outdoorrecAnnouncements: function() {
			this.outdoorrecAnnouncementsView = new announcementView({
				url: "../urex-app-backend/public/api/announcement/category/2",
			});
			return this.outdoorrecAnnouncementsView;
		},
		outdoorrecTrips: function() {
			this.outdoorrecTripsView = new eventView({
				url: "../urex-app-backend/public/api/event/category/2",
			});
			return this.outdoorrecTripsView;
		},
		outdoorrecPhotos: function() {
				this.outdoorrecPhotosView = new imageView({
					url: "../urex-app-backend/public/api/image/category/2",
				});
			return this.outdoorrecPhotosView;
		},
		intramuralsHome: function() {
			this.intramuralsHomeView = new homeView({
				url: "../urex-app-backend/public/api/hour/category/1",
				sub: $("#intramuralsMenu"),
				name: "Intramurals"
			});
			return this.intramuralsHomeView;
		},
		intramuralsAnnouncements: function() {
			this.intramuralsAnnouncementsView = new announcementView({
				url: "../urex-app-backend/public/api/announcement/category/3",
			});
			return this.intramuralsAnnouncementsView;
		},
		intramuralsPhotos: function() {
				this.intramuralsPhotosView = new imageView({
					url: "../urex-app-backend/public/api/image/category/3",
				});
			return this.intramuralsPhotosView;
		},
		climbingwallHome: function() {
				this.climbingwallHomeView = new homeView({
					url: "../urex-app-backend/public/api/hour/category/3",
					sub: $("#climbingwallMenu"),
					name: "The Climbing Wall"
				});
			return this.climbingwallHomeView;
		},
		climbingwallAnnouncements: function() {
				this.climbingwallAnnouncementsView = new announcementView({
					url: "../urex-app-backend/public/api/announcement/category/4",
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
					url: "../urex-app-backend/public/api/image/category/4",
				});
			return this.climbingwallPhotosView;
		},
		climbingwallEvents: function() {
			this.climbingwallEventsView = new eventView({
				url: "../urex-app-backend/public/api/event/category/4",
			});
			return this.climbingwallEventsView;
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
		},
		rentals: function() {
			this.rentalsView = new rentalView({
				url: "../urex-app-backend/public/api/item_rental",
			});
			return this.rentalsView;
		}
	};

	api.viewsFactory = ViewsFactory;

	// api.facilityView = ViewsFactory.facilityHome();

	var Router = Backbone.Router.extend({
		routes: {
			"facility": "facilityHome",
			"facility/announcements": "facilityAnnouncements",
			"facility/hours": "facilityHours",
			"facility/programs": "facilityProg",
			"facility/programs/remove/:id": "facilityRemoveProg",
			"facility/events": "facilityEvents",
			"facility/photos": "facilityPhotos",
			"facility/feedback": "facilityFeedback",
			"facility/remove/:id": "facilityRemove",
			"outdoorrec": "outdoorrecHome",
			"outdoorrec/announcements": "outdoorrecAnnouncements",
			"outdoorrec/trips": "outdoorrecTrips",
			"outdoorrec/photos": "outdoorrecPhotos",
			"outdoorrec/remove/:id": "outdoorrecRemove",
			"intramurals": "intramuralsHome",
			"intramurals/announcements": "intramuralsAnnouncements",
			"intramurals/photos": "intramuralsPhotos",
			"climbingwall": "climbingwallHome",
			"climbingwall/announcements": "climbingwallAnnouncements",
			"climbingwall/hours": "climbingwallHours",
			"climbingwall/photos": "climbingwallPhotos",
			"climbingwall/events": "climbingwallEvents",
			"rentals": "rentals",
			"": "home",
		},
		home: function() {
			api.changeContent(ViewsFactory.main());
		},
		facilityHome: function() {
			api.changeContent(ViewsFactory.facilityHome().$el);
		},
		facilityAnnouncements: function() {
			api.changeContent(ViewsFactory.facilityAnnouncements().$el);
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
		outdoorrecAnnouncements: function() {
			api.changeContent(ViewsFactory.outdoorrecAnnouncements().$el);
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
		intramuralsAnnouncements: function() {
			api.changeContent(ViewsFactory.intramuralsAnnouncements().$el);
		},
		intramuralsPhotos: function() {
			api.changeContent(ViewsFactory.intramuralsPhotos().$el);
		},
		climbingwallHome: function() {
			api.changeContent(ViewsFactory.climbingwallHome().$el);
		},
		climbingwallAnnouncements: function() {
			api.changeContent(ViewsFactory.climbingwallAnnouncements().$el);
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
		}
	});
	api.router = new Router();

	return api;

})();
