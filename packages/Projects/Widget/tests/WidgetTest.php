<?php 
namespace Tests\Feature;

use Orchestra\Testbench\TestCase;
use Projects\Widget\WidgetServiceProvider;
use Projects\Widget\Widget;


class WidgetTest extends TestCase
{
    
    protected function getPackageProviders($app)
    {
        
        return [
            WidgetServiceProvider::class
        ];
    }
    
    /** @test */
    public function it_compiles_the_widget_blade_directive()
    {
        
        $string = "@widget('Projects\Widget\Tests\TestWidget')";
        $expected  = "<?= resolve('Projects\Widget\Tests\TestWidget')->loadView(); ?>";
        
        $compiled = resolve('blade.compiler')->compileString($string);
        
        $this->assertEquals($expected, $compiled);
    }
    
    /** @test */
    public function it_choose_a_default_view_name_based_on_the_class()
    {
        
        $widget = new TestWidget();
        
        $this->assertEquals('test-widget', $widget->viewName());
        
    }
    
    /** @test */
    public function all_public_properties_are_available_to_the_view()
    {
        $this->assertStringContainsString('Test widget', TestWidget::render());
    }
    
    /** @test */
    public function all_public_methods_are_available_to_the_view()
    {
        
        $view = TestWidget::render();
        
        $this->assertStringContainsString('Item 1', $view);
        $this->assertStringContainsString('Item 2', $view);
    }
}


class TestWidget extends Widget{
    
    public $title = 'Test widget';
    
    public function items()
    {
        return ['Item 1', 'Item 2'];
    }
    
    public function view()
    {
        return view()->file(__DIR__.'/stubs/test-widget.blade.php');
    }
}