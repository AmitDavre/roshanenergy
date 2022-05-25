<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * MeasurementUnit Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 * Note: This endpoint is in beta.
 */
class MeasurementUnit implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'custom_unit' => '\SquareConnect\Model\MeasurementUnitCustom',
        'area_unit' => 'string',
        'length_unit' => 'string',
        'volume_unit' => 'string',
        'weight_unit' => 'string',
        'generic_unit' => 'string',
        'time_unit' => 'string',
        'type' => 'string'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'custom_unit' => 'custom_unit',
        'area_unit' => 'area_unit',
        'length_unit' => 'length_unit',
        'volume_unit' => 'volume_unit',
        'weight_unit' => 'weight_unit',
        'generic_unit' => 'generic_unit',
        'time_unit' => 'time_unit',
        'type' => 'type'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'custom_unit' => 'setCustomUnit',
        'area_unit' => 'setAreaUnit',
        'length_unit' => 'setLengthUnit',
        'volume_unit' => 'setVolumeUnit',
        'weight_unit' => 'setWeightUnit',
        'generic_unit' => 'setGenericUnit',
        'time_unit' => 'setTimeUnit',
        'type' => 'setType'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'custom_unit' => 'getCustomUnit',
        'area_unit' => 'getAreaUnit',
        'length_unit' => 'getLengthUnit',
        'volume_unit' => 'getVolumeUnit',
        'weight_unit' => 'getWeightUnit',
        'generic_unit' => 'getGenericUnit',
        'time_unit' => 'getTimeUnit',
        'type' => 'getType'
    );
  
    /**
      * $custom_unit A custom unit of measurement defined by the seller using the Point of Sale app or ad-hoc as an order line item.
      * @var \SquareConnect\Model\MeasurementUnitCustom
      */
    protected $custom_unit;
    /**
      * $area_unit Represents a standard area unit. See [MeasurementUnitArea](#type-measurementunitarea) for possible values
      * @var string
      */
    protected $area_unit;
    /**
      * $length_unit Represents a standard length unit. See [MeasurementUnitLength](#type-measurementunitlength) for possible values
      * @var string
      */
    protected $length_unit;
    /**
      * $volume_unit Represents a standard volume unit. See [MeasurementUnitVolume](#type-measurementunitvolume) for possible values
      * @var string
      */
    protected $volume_unit;
    /**
      * $weight_unit Represents a standard unit of weight or mass. See [MeasurementUnitWeight](#type-measurementunitweight) for possible values
      * @var string
      */
    protected $weight_unit;
    /**
      * $generic_unit Reserved for API integrations that lack the ability to specify a real measurement unit See [MeasurementUnitGeneric](#type-measurementunitgeneric) for possible values
      * @var string
      */
    protected $generic_unit;
    /**
      * $time_unit Represents a standard unit of time. See [MeasurementUnitTime](#type-measurementunittime) for possible values
      * @var string
      */
    protected $time_unit;
    /**
      * $type Represents the type of the measurement unit. See [MeasurementUnitUnitType](#type-measurementunitunittype) for possible values
      * @var string
      */
    protected $type;

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initializing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            if (isset($data["custom_unit"])) {
              $this->custom_unit = $data["custom_unit"];
            } else {
              $this->custom_unit = null;
            }
            if (isset($data["area_unit"])) {
              $this->area_unit = $data["area_unit"];
            } else {
              $this->area_unit = null;
            }
            if (isset($data["length_unit"])) {
              $this->length_unit = $data["length_unit"];
            } else {
              $this->length_unit = null;
            }
            if (isset($data["volume_unit"])) {
              $this->volume_unit = $data["volume_unit"];
            } else {
              $this->volume_unit = null;
            }
            if (isset($data["weight_unit"])) {
              $this->weight_unit = $data["weight_unit"];
            } else {
              $this->weight_unit = null;
            }
            if (isset($data["generic_unit"])) {
              $this->generic_unit = $data["generic_unit"];
            } else {
              $this->generic_unit = null;
            }
            if (isset($data["time_unit"])) {
              $this->time_unit = $data["time_unit"];
            } else {
              $this->time_unit = null;
            }
            if (isset($data["type"])) {
              $this->type = $data["type"];
            } else {
              $this->type = null;
            }
        }
    }
    /**
     * Gets custom_unit
     * @return \SquareConnect\Model\MeasurementUnitCustom
     */
    public function getCustomUnit()
    {
        return $this->custom_unit;
    }
  
    /**
     * Sets custom_unit
     * @param \SquareConnect\Model\MeasurementUnitCustom $custom_unit A custom unit of measurement defined by the seller using the Point of Sale app or ad-hoc as an order line item.
     * @return $this
     */
    public function setCustomUnit($custom_unit)
    {
        $this->custom_unit = $custom_unit;
        return $this;
    }
    /**
     * Gets area_unit
     * @return string
     */
    public function getAreaUnit()
    {
        return $this->area_unit;
    }
  
    /**
     * Sets area_unit
     * @param string $area_unit Represents a standard area unit. See [MeasurementUnitArea](#type-measurementunitarea) for possible values
     * @return $this
     */
    public function setAreaUnit($area_unit)
    {
        $this->area_unit = $area_unit;
        return $this;
    }
    /**
     * Gets length_unit
     * @return string
     */
    public function getLengthUnit()
    {
        return $this->length_unit;
    }
  
    /**
     * Sets length_unit
     * @param string $length_unit Represents a standard length unit. See [MeasurementUnitLength](#type-measurementunitlength) for possible values
     * @return $this
     */
    public function setLengthUnit($length_unit)
    {
        $this->length_unit = $length_unit;
        return $this;
    }
    /**
     * Gets volume_unit
     * @return string
     */
    public function getVolumeUnit()
    {
        return $this->volume_unit;
    }
  
    /**
     * Sets volume_unit
     * @param string $volume_unit Represents a standard volume unit. See [MeasurementUnitVolume](#type-measurementunitvolume) for possible values
     * @return $this
     */
    public function setVolumeUnit($volume_unit)
    {
        $this->volume_unit = $volume_unit;
        return $this;
    }
    /**
     * Gets weight_unit
     * @return string
     */
    public function getWeightUnit()
    {
        return $this->weight_unit;
    }
  
    /**
     * Sets weight_unit
     * @param string $weight_unit Represents a standard unit of weight or mass. See [MeasurementUnitWeight](#type-measurementunitweight) for possible values
     * @return $this
     */
    public function setWeightUnit($weight_unit)
    {
        $this->weight_unit = $weight_unit;
        return $this;
    }
    /**
     * Gets generic_unit
     * @return string
     */
    public function getGenericUnit()
    {
        return $this->generic_unit;
    }
  
    /**
     * Sets generic_unit
     * @param string $generic_unit Reserved for API integrations that lack the ability to specify a real measurement unit See [MeasurementUnitGeneric](#type-measurementunitgeneric) for possible values
     * @return $this
     */
    public function setGenericUnit($generic_unit)
    {
        $this->generic_unit = $generic_unit;
        return $this;
    }
    /**
     * Gets time_unit
     * @return string
     */
    public function getTimeUnit()
    {
        return $this->time_unit;
    }
  
    /**
     * Sets time_unit
     * @param string $time_unit Represents a standard unit of time. See [MeasurementUnitTime](#type-measurementunittime) for possible values
     * @return $this
     */
    public function setTimeUnit($time_unit)
    {
        $this->time_unit = $time_unit;
        return $this;
    }
    /**
     * Gets type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
  
    /**
     * Sets type
     * @param string $type Represents the type of the measurement unit. See [MeasurementUnitUnitType](#type-measurementunitunittype) for possible values
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }
  
    /**
     * Gets offset.
     * @param  integer $offset Offset 
     * @return mixed 
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }
  
    /**
     * Sets value based on offset.
     * @param  integer $offset Offset 
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }
  
    /**
     * Unsets offset.
     * @param  integer $offset Offset 
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
  
    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        } else {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this));
        }
    }
}
