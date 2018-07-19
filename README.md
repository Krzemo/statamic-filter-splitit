# 'SplitIt' - a Statamic filter

It allows to split and display a collection entries in **n** separate iterations.

I.e.:
```html
        <ul>
          {{ collection from="c_services" filter="splitit" currentcolumn="1" totalcolumns="3" layout="horizontal" sort="title:asc" }}
          <li class="{{ nfz }}"><a href="{{ url }}">{{ title }}</a></li>
          {{ /collection }}
        </ul>
        <ul>
            {{ collection from="c_services" filter="splitit" currentcolumn="2" totalcolumns="3"  layout="horizontal" sort="title:asc"  }}
            <li class="{{ nfz }}"><a href="{{ url }}">{{ title }} </a></li>
            {{ /collection }}
        </ul>
        <ul>
            {{ collection from="c_services" filter="splitit" currentcolumn="3" totalcolumns="3"  layout="horizontal" sort="title:asc" }}
            <li class="{{ nfz }}"><a href="{{ url }}">{{ title }} </a></li>
            {{ /collection }}
        </ul>
```
