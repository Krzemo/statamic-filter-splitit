<?php

namespace Statamic\SiteHelpers;

use Statamic\Extend\Filter;
use Statamic\API\Collection;
use Statamic\API\Entry;

class Filters extends Filter
{
    private $nc;
    private $column;
    private $total_columns;
    private $layout;
    private $number_of_entries;

    /**
     * Maps to {{ collection:handle filter="example" }}
     *
     * @param \Illuminate\Support\Collection $collection
     * @return \Illuminate\Support\Collection
     */
    public function splitit($collection)
    {
        $this->column               = $this->get('currentcolumn', 1);
        $this->total_columns        = $this->get('totalcolumns', 1);
        $this->layout               = $this->get('layout', 'vertical');
        $this->number_of_entries    = $collection->count();
        $this->nc                   = array();


        if($this->layout == 'horizontal')
        {
            $cnt = 1;
            foreach($collection as $key => $ce)
            {
                $rownumber = (int)ceil($cnt/$this->total_columns);

                if(($cnt+($this->total_columns-$this->column))%$this->total_columns == 0)
                {
                    $this->nc[$key] = $key;
                }
                $cnt++;
            }
        }
        else
        {
            $epc = ceil($this->number_of_entries / $this->total_columns); //entries per column
            $entries_shown = 0;
            $entries_left_to_show = $this->number_of_entries;
            $cnt = 0;

            $cs = $collection->sortBy('title')->values()->all();
            
            foreach($cs as $key => $ce)
            {


                if($cnt >= ($epc * ($this->column - 1)) && ($cnt <= ($epc * $this->column <= $this->number_of_entries ? $epc * $this->column : $this->number_of_entries - 1)))
                {
                    $this->nc[] = $ce->get('id');
                }
                
                $cnt++;
            }

        }

        return $this->collection->filter(function ($entry) {
            return in_array($entry->get('id'), $this->nc);
        });
        
    }
}
