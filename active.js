if(this.location.pathname === "/")
	$("a[href='" + this.location.pathname + "']").parents("li").addClass("active");
else
	$("a[href='" + this.location.pathname + "']").parents("li").addClass("active");
console.log(this.location);
console.log(this.location.pathname);