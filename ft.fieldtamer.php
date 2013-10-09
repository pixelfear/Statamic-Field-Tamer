<?php
/**
 * Fieldtype_fieldtamer
 * Allows fields to be moved around and organized
 *
 * @author  Jason Varga <jason@pixelfear.com>
 *
 * @copyright  2013
 * @link       http://pixelfear.com
 */
class Fieldtype_fieldtamer extends Fieldtype
{
    /**
     * Meta data for this fieldtype
     * @var array
     */
    public $meta = array(
        'name'       => 'Field Tamer',
        'version'    => '1.0',
        'author'     => 'Jason Varga',
        'author_url' => 'http://pixelfear.com'
    );

	public function render()
	{
		// Field ID
		$placeholder = 'fieldtamer-' . $this->field;

		// Section header
		$header = '
			<div class="fieldtamer-header">'.
				$this->render_label().
				$this->render_instructions_above().
			'</div>
		';

		// Field placeholder
		$fields = '<div class="fieldtamer-fields" id="'.$placeholder.'"></div>';

		// JavaScript
		$js = $this->js->inline('
			(function() {
				var fieldContainer = $(".section.content");
				var fields = '. json_encode($this->field_config['fields']) .';
				var newFields = [];
				$(fields).each(function(key, val) {
					var fieldSelector = (val === "content") 
					                    ? "[name=\'page[content]\']" 
					                    : "[name^=\'page[yaml]["+val+"]\'], [data-empty-row*=\'page[yaml]["+val+"]\']";
					var inputRow = fieldContainer.find(fieldSelector).first().closest(".input-block");
					inputRow.appendTo("#'.$placeholder.'");
				});
				
			})();
		');

		// Output
		$html = $header . $fields . $js;
		return $html;
	}

	public function render_field()
	{
		return $this->render();
	}

}