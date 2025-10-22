<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* components/itilobject/timeline/new_form.html.twig */
class __TwigTemplate_3543fd6d8c54fecc65a7c1ae450f2a0d55c4b1eeb382e236b7fcdb66dcdba6b9 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        yield "
";
        // line 34
        $context["users_id"] = $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiID");
        // line 35
        yield "
<div class=\"itil-timeline\">
   <div class=\"timeline-item ITILContent\">
      <div class=\"row\">
         <div class=\"col-auto d-flex flex-column picture-block\">
            ";
        // line 40
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/user/picture.html.twig", ["users_id" => ($context["users_id"] ?? null)], false);
        yield "
         </div>
         <div class=\"col-12 col-sm content-block\">
            <div class=\"d-flex\">
               <div class=\"d-none d-md-block\">
                  <strong>";
        // line 45
        yield $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemLink("User", ($context["users_id"] ?? null));
        yield "</strong>
               </div>
            </div>
            <span class=\"mt-2 timeline-content left card\">
               <div class=\"card-body\">
                  ";
        // line 50
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 50)) {
            // line 51
            yield "                     <div class=\"alert alert-info\" role=\"alert\">
                        ";
            // line 52
            $context["entitybadge"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 53
                yield "                           <span class=\"ms-1\">
                              ";
                // line 54
                yield $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Entity::badgeCompletenameById", [(($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 54)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["entities_id"] ?? null) : null)]);
                yield "
                           </span>
                        ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 57
            yield "
                        ";
            // line 58
            yield Twig\Extension\CoreExtension::sprintf(__("%1\$s will be added in entity %2\$s"), CoreExtension::getAttribute($this->env, $this->source,             // line 59
($context["item"] ?? null), "getTypeName", [1], "method", false, false, false, 59),             // line 60
($context["entitybadge"] ?? null));
            // line 61
            yield "
                     </div>
                  ";
        }
        // line 64
        yield "
                  ";
        // line 65
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/timeline/simple_form.html.twig", ["no_form" => true]);
        // line 67
        yield "
               </div>
            </span>
         </div>
      </div>
   </div>
</div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/timeline/new_form.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  100 => 67,  98 => 65,  95 => 64,  90 => 61,  88 => 60,  87 => 59,  86 => 58,  83 => 57,  76 => 54,  73 => 53,  71 => 52,  68 => 51,  66 => 50,  58 => 45,  50 => 40,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/timeline/new_form.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\timeline\\new_form.html.twig");
    }
}
