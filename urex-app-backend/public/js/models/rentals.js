//Model
app.models.rental = Backbone.Model.extend({
	initialize: function() {
		console.log("Initialized model");
	},
	defaults: {
		name: "Item",
		s_price1: 10,
		s_price2: 10,
		s_price3: 10,
		s_price4: 10,
		f_price1: 10,
		f_price2: 10,
		f_price3: 10,
		f_price4: 10
	}
});