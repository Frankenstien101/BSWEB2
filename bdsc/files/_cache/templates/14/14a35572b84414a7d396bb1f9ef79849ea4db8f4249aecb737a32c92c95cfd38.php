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

/* components/itilobject/timeline/pending_reasons.html.twig */
class __TwigTemplate_590523993cccb86750999737dee9ee07e2371c03b629bab643e22072e863e2b0 extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/timeline/pending_reasons.html.twig", 34)->unwrap();
        // line 35
        yield "
";
        // line 36
        if ($this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PendingReason_Item::canDisplayPendingReasonForItem", [($context["subitem"] ?? null)])) {
            // line 37
            yield "   ";
            $context["pending_item"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PendingReason_Item::getForItem", [($context["subitem"] ?? null), true]);
            // line 38
            yield "   ";
            $context["pending_item_parent"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PendingReason_Item::getForItem", [($context["item"] ?? null), true]);
            // line 39
            yield "   ";
            $context["pendingreasons_id"] = (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["pending_item"] ?? null), "fields", [], "any", false, true, false, 39), "pendingreasons_id", [], "array", true, true, false, 39) &&  !(null === (($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["pending_item"] ?? null), "fields", [], "any", false, true, false, 39)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["pendingreasons_id"] ?? null) : null)))) ? ((($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source, ($context["pending_item"] ?? null), "fields", [], "any", false, true, false, 39)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["pendingreasons_id"] ?? null) : null)) : ((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["pending_item_parent"] ?? null), "fields", [], "any", false, true, false, 39), "pendingreasons_id", [], "array", true, true, false, 39) &&  !(null === (($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source, ($context["pending_item_parent"] ?? null), "fields", [], "any", false, true, false, 39)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["pendingreasons_id"] ?? null) : null)))) ? ((($__internal_compile_3 = CoreExtension::getAttribute($this->env, $this->source, ($context["pending_item_parent"] ?? null), "fields", [], "any", false, true, false, 39)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["pendingreasons_id"] ?? null) : null)) : (0))));
            // line 40
            yield "
   <div class=\"row\">
      <div class=\"col-12 col-sm-4\" title=\"";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("PendingReason"), "html", null, true);
            yield "\"
           data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
         ";
            // line 44
            $context["pendingreasons_lbl"] = ('' === $tmp = "            <i class=\"fas fa-tags fa-fw\"></i>
         ") ? '' : new Markup($tmp, $this->env->getCharset());
            // line 47
            yield "         ";
            $context["pending_reasons_id_script"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 48
                yield "            <script>
               var myCollapsible = \$('#pending-reasons-setup-";
                // line 49
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                yield "')[0];
               myCollapsible.addEventListener('show.bs.collapse', function () {
                  \$('#pending-reasons-control-";
                // line 51
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                yield "').addClass('flex-fill');
               });
               myCollapsible.addEventListener('hide.bs.collapse', function () {
                  \$('#pending-reasons-control-";
                // line 54
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                yield "').removeClass('flex-fill');
               });
            </script>
         ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 58
            yield "         ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["PendingReason", "pendingreasons_id",             // line 61
($context["pendingreasons_id"] ?? null),             // line 62
($context["pendingreasons_lbl"] ?? null), ["label_class" => "col-1", "input_class" => "col-10 ms-1", "rand" =>             // line 66
($context["rand"] ?? null), "mb" => "", "hide_if_no_elements" => true, "addicon" => false, "comments" => false, "width" => "95%", "field_class" => "flex-nowrap", "add_field_html" =>             // line 73
($context["pending_reasons_id_script"] ?? null)]], 58, $context, $this->getSourceContext());
            // line 75
            yield "
         <script>
            \$('#dropdown_pendingreasons_id";
            // line 77
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "').change(function() {
               var pending_val = \$(this).val();
               if (pending_val > 0) {
                  \$('#pending-reasons-more_options_";
            // line 80
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "').addClass('show');
                  \$.ajax({
                     url: '";
            // line 82
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("ajax/pendingreason.php"), "html", null, true);
            yield "',
                     type: 'POST',
                     data: {
                        pendingreasons_id: pending_val
                     }
                  }).done(function(data) {
                     \$('#dropdown_followup_frequency";
            // line 88
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "')
                        .val(data.followup_frequency)
                        .trigger('change');
                     \$('#dropdown_followups_before_resolution";
            // line 91
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "')
                        .val(data.followups_before_resolution)
                        .trigger('change');
                  });
               } else {
                  \$('#pending-reasons-more_options_";
            // line 96
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "').removeClass('show');
               }
            });
         </script>
      </div>

      <div class=\"collapse col-12 col-sm-8 ";
            // line 102
            yield ((($context["pendingreasons_id"] ?? null)) ? ("show") : (""));
            yield "\" id=\"pending-reasons-more_options_";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
            yield "\">
         <div class=\"row\">
            <div class=\"col-12 col-sm-6\" title=\"";
            // line 104
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Automatic follow-up"), "html", null, true);
            yield "\"
                  data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
               ";
            // line 106
            $context["pendingreasons_frequency_field"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PendingReason::displayFollowupFrequencyfield", [((            // line 107
($context["pending_item"] ?? null)) ? ((($__internal_compile_4 = CoreExtension::getAttribute($this->env, $this->source, ($context["pending_item"] ?? null), "fields", [], "any", false, false, false, 107)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["followup_frequency"] ?? null) : null)) : ((($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source, ($context["pending_item_parent"] ?? null), "fields", [], "any", false, false, false, 107)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["followup_frequency"] ?? null) : null))), "", ["rand" =>             // line 110
($context["rand"] ?? null)], false]);
            // line 114
            yield "               ";
            $context["pendingreasons_frequency_lbl"] = ('' === $tmp = "                  <i class=\"fas fa-redo fa-fw\"></i>
               ") ? '' : new Markup($tmp, $this->env->getCharset());
            // line 117
            yield "               ";
            yield CoreExtension::callMacro($macros["fields"], "macro_field", ["followup_frequency",             // line 119
($context["pendingreasons_frequency_field"] ?? null),             // line 120
($context["pendingreasons_frequency_lbl"] ?? null), ["field_class" => "", "label_class" => "col-1", "input_class" => "col-10 ms-1", "rand" =>             // line 125
($context["rand"] ?? null), "mb" => ""]], 117, $context, $this->getSourceContext());
            // line 128
            yield "
            </div>
            <div class=\"col-12 col-sm-6\" title=\"";
            // line 130
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Automatic resolution"), "html", null, true);
            yield "\"
                 data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
               ";
            // line 132
            $context["pendingreasons_resolution_field"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PendingReason::displayFollowupsNumberBeforeResolutionField", [((            // line 133
($context["pending_item"] ?? null)) ? ((($__internal_compile_6 = CoreExtension::getAttribute($this->env, $this->source, ($context["pending_item"] ?? null), "fields", [], "any", false, false, false, 133)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["followups_before_resolution"] ?? null) : null)) : ((($__internal_compile_7 = CoreExtension::getAttribute($this->env, $this->source, ($context["pending_item_parent"] ?? null), "fields", [], "any", false, false, false, 133)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["followups_before_resolution"] ?? null) : null))), "", ["rand" =>             // line 136
($context["rand"] ?? null)], false]);
            // line 140
            yield "               ";
            $context["pendingreasons_resolution_lbl"] = ('' === $tmp = "                  <i class=\"fas fa-check fa-fw\"></i>
               ") ? '' : new Markup($tmp, $this->env->getCharset());
            // line 143
            yield "               ";
            yield CoreExtension::callMacro($macros["fields"], "macro_field", ["followups_before_resolution",             // line 145
($context["pendingreasons_resolution_field"] ?? null),             // line 146
($context["pendingreasons_resolution_lbl"] ?? null), ["field_class" => "", "label_class" => "col-1", "input_class" => "col-10 ms-1", "rand" =>             // line 151
($context["rand"] ?? null), "mb" => ""]], 143, $context, $this->getSourceContext());
            // line 154
            yield "
            </div>
         </div>
      </div>
   </div>
";
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/timeline/pending_reasons.html.twig";
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
        return array (  197 => 154,  195 => 151,  194 => 146,  193 => 145,  191 => 143,  187 => 140,  185 => 136,  184 => 133,  183 => 132,  178 => 130,  174 => 128,  172 => 125,  171 => 120,  170 => 119,  168 => 117,  164 => 114,  162 => 110,  161 => 107,  160 => 106,  155 => 104,  148 => 102,  139 => 96,  131 => 91,  125 => 88,  116 => 82,  111 => 80,  105 => 77,  101 => 75,  99 => 73,  98 => 66,  97 => 62,  96 => 61,  94 => 58,  86 => 54,  80 => 51,  75 => 49,  72 => 48,  69 => 47,  66 => 44,  61 => 42,  57 => 40,  54 => 39,  51 => 38,  48 => 37,  46 => 36,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/timeline/pending_reasons.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\timeline\\pending_reasons.html.twig");
    }
}
