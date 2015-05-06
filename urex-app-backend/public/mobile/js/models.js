var Announcement = Backbone.Model.extend({
  defaults: {
    id: null,
    title: "New Title",
    message: "Details",
    date: "05/22/1993"
  }
});

var Image = Backbone.Model.extend({
  defaults: {
    id: null,
    file_location: null,
    caption: "Sample Title",
    file: null,
    filename: null,
    extension: null
    // category_id: null
  }
});

var Program = Backbone.Model.extend({
  defaults: {
    id: null,
    title: "Sample Title",
    description: "Sample Description",
  }
});

var Rental = Backbone.Model.extend({
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
