//Collection
var TempRentals = Backbone.Collection.extend({
	initialize: function() {
		// var self = this;
		// this.items =  [];
		// $.getJSON("resources/rental_info.json").done(function(data) {
		// 	$.each(data, function(key, val) {
		// 		console.log("Loaded item " + val.name);
		// 		self.items.push(val);
		// 		// TempRentals.add(val);
		// 		// self.add({
		// 		// 	name: val.name,
		// 		// 	s_price1: val.s_price1,
		// 		// 	s_price2: val.s_price2,
		// 		// 	s_price3: val.s_price3,
		// 		// 	s_price4: val.s_price4,
		// 		// 	f_price1: val.f_price1,
		// 		// 	f_price2: val.f_price2,
		// 		// 	f_price3: val.f_price3,
		// 		// 	f_price4: val.f_price4
		// 		// });
		// 	});
			
		// });
		// console.log(this.items);
	},
	load: function() {
		var self = this;
		this.items.forEach(function() {
			console.log("hit");
			self.add(this);
		});
	},
	default: {
		collection: app.models.rentals
	},
	model: app.models.rentals,
	url: 'resources/rental_info.json',
	parse: function(response) {
		return response;
	}
});

// app.collections.rentals = new rentalTemp();
// app.collections.rentals.fetch();