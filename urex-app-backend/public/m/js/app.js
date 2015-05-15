//Mobile App.js
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
			$.ajaxSetup({
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
		main: function() {
			return $("#main").html();
		},
		facilityHome: function() {
			if(!this.facilityHomeView) {
				this.facilityHomeView = new homeView({
					url: "../api/hour/category/2",
					sub: $("#facilityMenu"),
					name: "U-Rec",
					toggle: false,
				});
			}
			return this.facilityHomeView;
		},
		facilityAnnouncements: function() {
			if(!this.facilityAnnouncementsView) {
				this.facilityAnnouncementsView = new announcementView({
					url: "../api/announcement/category/2",
				});
			}
			return this.facilityAnnouncementsView;
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
			if(!this.facilityEventsView) {
				this.facilityEventsView = new eventView({
					url: "../api/event/category/2",
				});
			}
			return this.facilityEventsView;
		},
		facilityPhotos: function() {
			if(!this.facilityPhotosView) {
				this.facilityPhotosView = new imageView({
					url: "../api/image/category/2",
				});
			}
			return this.facilityPhotosView;
		},
		facilityFeedback: function() {
			// if(!this.facilityFeedbackView) {
			// 	this.facilityFeedbackView = new api.views.facilityFeedback();
			// }
			return $("#feedback").html();
		},
		outdoorrecHome: function() {
			if(!this.outdoorrecHomeView) {
				this.outdoorrecHomeView = new homeView({
					url: "../api/hour/category/3",
					sub: $("#outdoorrecMenu"),
					name: "Outdoor Rec",
					toggle: true,
				});
			}
			return this.outdoorrecHomeView;
		},
		outdoorrecAnnouncements: function() {
			if(!this.outdoorrecAnnouncementsView) {
			this.outdoorrecAnnouncementsView = new announcementView({
				url: "../api/announcement/category/3",
			});
		}
			return this.outdoorrecAnnouncementsView;
		},
		outdoorrecTrips: function() {
			if(!this.outdoorrecTripsView) {
			this.outdoorrecTripsView = new eventView({
				url: "../api/event/category/3",
			});
		}
			return this.outdoorrecTripsView;
		},
		outdoorrecPhotos: function() {
			if(!this.outdoorrecPhotosView) {
				this.outdoorrecPhotosView = new imageView({
					url: "../api/image/category/3",
				});
			}
			return this.outdoorrecPhotosView;
		},
		intramuralsHome: function() {
			if(!this.intramuralsHomeView) {
			this.intramuralsHomeView = new homeView({
				url: "../api/hour/category/2",
				sub: $("#intramuralsMenu"),
				name: "Intramurals",
				toggle: true,
			});
		}
			return this.intramuralsHomeView;
		},
		intramuralsAnnouncements: function() {
			if(!this.intramuralsAnnouncementsView) {
			this.intramuralsAnnouncementsView = new announcementView({
				url: "../api/announcement/category/4",
			});
		}
			return this.intramuralsAnnouncementsView;
		},
		intramuralsPhotos: function() {
			if(!this.intramuralsPhotosView) {
				this.intramuralsPhotosView = new imageView({
					url: "../api/image/category/4",
				});
			}
			return this.intramuralsPhotosView;
		},
		climbingwallHome: function() {
			if(!this.climbingwallHomeView) {
				this.climbingwallHomeView = new homeView({
					url: "../api/hour/category/5",
					sub: $("#climbingwallMenu"),
					name: "The Climbing Wall",
					toggle: false
				});
			}
			return this.climbingwallHomeView;
		},
		climbingwallAnnouncements: function() {
			if(!this.climbingwallAnnouncementsView) {
				this.climbingwallAnnouncementsView = new announcementView({
					url: "../api/announcement/category/5",
				});
			}
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
			if(!this.climbingwallPhotosView) {
				this.climbingwallPhotosView = new imageView({
					url: "../api/image/category/5",
				});
			}
			return this.climbingwallPhotosView;
		},
		climbingwallEvents: function() {
			if(!this.climbingwallEventsView) {
			this.climbingwallEventsView = new eventView({
				url: "../api/event/category/5",
			});
		}
			return this.climbingwallEventsView;
		},
		rentals: function() {
			// if(!this.rentalsView) {
			this.rentalsView = new rentalView({
				url: "../api/item_rental",
			});
		// }
			return this.rentalsView;
		},
		about: function() {
			return $("#aboutView").html();
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
			"about": "about",
			"": "home",
		},
		home: function() {
			$("title").html("Home");
			api.changeContent(ViewsFactory.main());
		},
		facilityHome: function() {
			$("title").html("U-Rec Center");
			api.changeContent(ViewsFactory.facilityHome().$el);
		},
		facilityAnnouncements: function() {
			$("title").html("U-Rec Announcements");
			api.changeContent(ViewsFactory.facilityAnnouncements().$el);
		},
		facilityHours: function() {
			api.changeContent(ViewsFactory.facilityHours().$el);
		},
		facilityProg: function() {
			$("title").html("U-Rec Programs");
			api.changeContent(ViewsFactory.facilityProg().$el);
		},
		facilityEvents: function() {
			$("title").html("U-Rec Events");
			api.changeContent(ViewsFactory.facilityEvents().$el);
		},
		facilityPhotos: function() {
			$("title").html("U-Rec Photos");
			api.changeContent(ViewsFactory.facilityPhotos().$el);
		},
		facilityFeedback: function() {
			$("title").html("Feedback");
			api.changeContent(ViewsFactory.facilityFeedback());
		},
		outdoorrecHome: function() {
			$("title").html("Outdoor Rec");
			api.changeContent(ViewsFactory.outdoorrecHome().$el);
		},
		outdoorrecAnnouncements: function() {
			$("title").html("Outdoor Rec Announcements");
			api.changeContent(ViewsFactory.outdoorrecAnnouncements().$el);
		},
		outdoorrecTrips: function() {
			$("title").html("Outdoor Rec Trips");
			api.changeContent(ViewsFactory.outdoorrecTrips().$el);
		},
		outdoorrecPhotos: function() {
			$("title").html("Outdoor Rec Photos");
			api.changeContent(ViewsFactory.outdoorrecPhotos().$el);
		},
		intramuralsHome: function() {
			$("title").html("Intramurals");
			api.changeContent(ViewsFactory.intramuralsHome().$el);
		},
		intramuralsAnnouncements: function() {
			$("title").html("Intramurals Announcements");
			api.changeContent(ViewsFactory.intramuralsAnnouncements().$el);
		},
		intramuralsPhotos: function() {
			$("title").html("Intramurals Photos");
			api.changeContent(ViewsFactory.intramuralsPhotos().$el);
		},
		climbingwallHome: function() {
			$("title").html("Climbing Wall");
			api.changeContent(ViewsFactory.climbingwallHome().$el);
		},
		climbingwallAnnouncements: function() {
			$("title").html("Climbing Wall Announcements");
			api.changeContent(ViewsFactory.climbingwallAnnouncements().$el);
		},
		climbingwallHours: function() {
			api.changeContent(ViewsFactory.climbingwallHours().$el);
		},
		climbingwallPhotos: function() {
			$("title").html("Climbingwall Photos");
			api.changeContent(ViewsFactory.climbingwallPhotos().$el);
		},
		climbingwallEvents: function() {
			$("title").html("Climbing Wall Events");
			api.changeContent(ViewsFactory.climbingwallEvents().$el);
		},
		rentals: function() {
			$("title").html("Rentals");
			api.changeContent(ViewsFactory.rentals().$el);
		},
		about: function() {
			$("title").html("About this App");
			api.changeContent(ViewsFactory.about());
		}
	});
	api.router = new Router();

	return api;

})();
