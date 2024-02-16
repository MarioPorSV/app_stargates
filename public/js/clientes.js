function ficha_cliente() {
	$("#ver_ficha").on("show.bs.modal", function(e) {
		var bookId = $(e.relatedTarget).data("book-id");
		var bookId1 = $(e.relatedTarget).data("book-id1");
		var bookId2 = $(e.relatedTarget).data("book-id2");
		var bookId3 = $(e.relatedTarget).data("book-id3");
		var bookId4 = $(e.relatedTarget).data("book-id4");
		var bookId5 = $(e.relatedTarget).data("book-id5");
		var bookId6 = $(e.relatedTarget).data("book-id6");
		var bookId7 = $(e.relatedTarget).data("book-id7");
		var bookId8 = $(e.relatedTarget).data("book-id8");
		var bookId9 = $(e.relatedTarget).data("book-id9");
		var bookId10 = $(e.relatedTarget).data("book-id10");
		var bookId11 = $(e.relatedTarget).data("book-id11");
		var bookId12 = $(e.relatedTarget).data("book-id12");
		var bookId13 = $(e.relatedTarget).data("book-id13");
		var bookId14 = $(e.relatedTarget).data("book-id14");
		var bookId15 = $(e.relatedTarget).data("book-id15");
		var bookId16 = $(e.relatedTarget).data("book-id16");
		var bookId17 = $(e.relatedTarget).data("book-id17");
		var bookId18 = $(e.relatedTarget).data("book-id18");
		var bookId19 = $(e.relatedTarget).data("book-id19");

		$(e.currentTarget)
			.find('input[name="nombres"]')
			.val(bookId);
		$(e.currentTarget)
			.find('input[name="apellidos"]')
			.val(bookId1);
		$(e.currentTarget)
			.find('input[name="tipocuenta"]')
			.val(bookId2);
		$(e.currentTarget)
			.find('input[name="fecha"]')
			.val(bookId3);
		$(e.currentTarget)
			.find('input[name="tipodoc"]')
			.val(bookId4);
		$(e.currentTarget)
			.find('input[name="pais"]')
			.val(bookId5);
		$(e.currentTarget)
			.find('input[name="numdoc"]')
			.val(bookId6);
		$(e.currentTarget)
			.find('input[name="nit"]')
			.val(bookId7);
		$(e.currentTarget)
			.find('input[name="nrc"]')
			.val(bookId8);
		$(e.currentTarget)
			.find('input[name="rsocial"]')
			.val(bookId9);

		$(e.currentTarget)
			.find('input[name="rlegal"]')
			.val(bookId10);
		$(e.currentTarget)
			.find('input[name="email"]')
			.val(bookId11);
		$(e.currentTarget)
			.find('input[name="telefono"]')
			.val(bookId12);
		$(e.currentTarget)
			.find('input[name="contacto"]')
			.val(bookId13);
		$(e.currentTarget)
			.find('input[name="oentrega"]')
			.val(bookId14);
		$(e.currentTarget)
			.find('input[name="lretiro"]')
            .val(bookId15);
        $(e.currentTarget)
			.find('input[name="departamento"]')
            .val(bookId16);
            
		$(e.currentTarget)
			.find('input[name="municipio"]')
			.val(bookId17);
		$(e.currentTarget)
			.find('input[name="direccion"]')
            .val(bookId18);
            
            $(e.currentTarget)
			.find('input[name="casillero"]')
			.val(bookId19);
	});
}

