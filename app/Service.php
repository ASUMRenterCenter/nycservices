<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Service extends Model
{
    use Sortable;

    protected $table = 'services';

    protected $primaryKey = 'id';
    
	public $timestamps = false;

	public function organization()
    {
        return $this->belongsTo('App\Organization', 'service_organization', 'organization_recordid');
    }

    public function location()
    {
        return $this->hasmany('App\Location', 'location_services', 'service_recordid');
    }

    public function taxonomy()
    {
        return $this->belongsTo('App\Taxonomy', 'service_taxonomy', 'taxonomy_recordid');
    }

    public function phone()
    {
        return $this->hasmany('App\Phone', 'phone_services', 'service_recordid');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Schedule', 'id', 'schedule_recordid');
    }

    public function contact()
    {
        return $this->belongsTo('App\Contact', 'service_contacts', 'contact_recordid');
    }

    public function detail()
    {
        return $this->hasmany('App\Detail', 'detail_services', 'service_recordid');
    }
}
