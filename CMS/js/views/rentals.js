//View
app.views.rentals = Backbone.View.extend({
	// template: _.template($("#rentals").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
		var html = '<div class="header aug-header"><h1>Equipment Rentals</h1></div><div class="content">    <table class="pure-table aug-table">        <thead>            <tr>                <th class="clear-head"></th>                <th class="aug-th">Student Rates</th>                <th class="aug-th">Faculty Rates</th>            </tr>        </thead>    </table>    <table class="pure-table pure-table-horizontal aug-table">        <thead>            <tr>                <th class="aug-tr-lead">Days</th>                <th>1</th>                <th>2-3</th>                <th>4-6</th>                <th>7-10</th>                <th>1</th>                <th>2-3</th>                <th>4-6</th>                <th>7-10</th>            </tr>        </thead><tbody>';
		var self = this;
		console.log(this.model);
		this.model.each(function(item) {
			var template = _.template($("rentalItem").html());
			html += template({
				name: item.get("name"),
				s1: item.get("s_price1"),
				s2: item.get("s_price2"),
				s3: item.get("s_price3"),
				s4: item.get("s_price4"),
				f1: item.get("f_price1"),
				f2: item.get("f_price2"),
				f3: item.get("f_price3"),
				f4: item.get("f_price4")
			});
			console.log(item);
		});
		html += '</tbody>    </table>    <div class="right">        <button class="button-warning pure-button"><i class="fa fa-pencil-square-o" />Edit Info</button>        <button class="button-error pure-button"><i class="fa fa-minus" />Remove Gear</button>        <button class="pure-button pure-button-primary"><i class="fa fa-plus" />Add new Gear</button>    </div></div>';
		this.$el.html(html);
		return this;
	}
});