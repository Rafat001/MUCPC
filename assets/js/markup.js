function markUP(str) {
  prv = str;
  while(1) {
    str = str.replace("[b]", "<b>");
    str = str.replace("[/b]", "</b>");
    str = str.replace("[i]", "<i>");
    str = str.replace("[/i]", "</i>");
    str = str.replace("[h1]", "<h1>");
    str = str.replace("[/h1]", "</h1>");
    str = str.replace("[h2]", "<h2>");
    str = str.replace("[/h2]", "</h2>");
    str = str.replace("[h3]", "<h3>");
    str = str.replace("[/h3]", "</h3>");
    str = str.replace("[h4]", "<h4>");
    str = str.replace("[/h4]", "</h4>");
    str = str.replace("[h5]", "<h5>");
    str = str.replace("[/h5]", "</h5>");
    str = str.replace("[ul]", "<ul>");
    str = str.replace("[/ul]", "</ul>");
    str = str.replace("[li]", "<li>");
    str = str.replace("[/li]", "</li>");
    str = str.replace("[ol]", "<ol>");
    str = str.replace("[/ol]", "</ol>");
    str = str.replace("[br]", "<br>");
    str = str.replace("[url](link)[", '<a href="');
    str = str.replace("](text)[", '">');
    str = str.replace("][/url]", '</a>');
    str = str.replace("[img](src)[", '<img width="50%" width="50%" src="');
    str = str.replace("](text)[", '">');
    str = str.replace("][/img]", '</a>');
    if(prv == str) break;
    prv = str
  }
  return str;
}