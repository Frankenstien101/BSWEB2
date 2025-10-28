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

/* pages/admin/events_list.html.twig */
class __TwigTemplate_418ec4c51b3c97506d6286015390cc545c4b192e9a91f891e02ccf673be15119 extends Template
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
<div class=\"container-fluid\">
   <div class=\"search_page\">
      <div class=\"search-container\">
         <div class=\"card card-sm search-card\">
            ";
        // line 38
        if ((0 === CoreExtension::compare(($context["count"] ?? null), 0))) {
            // line 39
            yield "               <div class=\"alert alert-info mb-0 rounded-0 border-top-0 border-bottom-0 border-right-0\" role=\"alert\">
                  ";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("No item found"), "html", null, true);
            yield "
               </div>
            ";
        } else {
            // line 43
            yield "               <div class=\"card-header search-header pe-0\">
                  ";
            // line 44
            if ((1 === CoreExtension::compare(($context["count"] ?? null), 0))) {
                // line 45
                yield "                     ";
                $context["limitdropdown"] = Twig\Extension\CoreExtension::include($this->env, $context, "components/dropdown/limit.html.twig", ["href" =>                 // line 46
($context["target"] ?? null), "additional_params" => ((("sort=" .                 // line 47
($context["sort"] ?? null)) . "&order=") . ($context["order"] ?? null))]);
                // line 49
                yield "                     <div class=\"ms-auto d-inline-flex align-items-center d-none d-md-block search-limit\">
                        ";
                // line 50
                yield Twig\Extension\CoreExtension::sprintf(__("Show %s entries"), ($context["limitdropdown"] ?? null));
                yield "
                     </div>
               ";
            }
            // line 53
            yield "               </div>
               <div class=\"table-responsive-md\">
                  <table class=\"search-results table table-hover table-card\">
                     <thead>
                        ";
            // line 57
            $context["headings"] = ["type" => __("Source"), "items_id" => __("ID"), "date" => _n("Date", "Dates", 1), "service" => __("Service"), "level" => __("Level"), "message" => __("Message")];
            // line 65
            yield "
                        ";
            // line 66
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["headings"] ?? null));
            foreach ($context['_seq'] as $context["field"] => $context["label"]) {
                // line 67
                yield "                           <th>
                              <a href=\"";
                // line 68
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["target"] ?? null), "html", null, true);
                yield "?sort=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["field"], "html", null, true);
                yield "&amp;order=";
                yield (((0 === CoreExtension::compare(($context["order"] ?? null), "ASC"))) ? ("DESC") : ("ASC"));
                yield "\">
                                 ";
                // line 69
                if ((0 === CoreExtension::compare(($context["sort"] ?? null), $context["field"]))) {
                    // line 70
                    yield "                                    ";
                    $context["sort_icon"] = (((0 === CoreExtension::compare(($context["order"] ?? null), "ASC"))) ? ("fa-sort-up") : ("fa-sort-down"));
                    // line 71
                    yield "                                    <i class=\"fas fa-lg ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["sort_icon"] ?? null), "html", null, true);
                    yield "\"></i>
                                 ";
                }
                // line 73
                yield "                                 ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield "
                              </a>
                           </th>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['field'], $context['label'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 77
            yield "                     </thead>
                     <tbody>
                        ";
            // line 79
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["events"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
                // line 80
                yield "                           <tr>
                              <td>
                                 <i class=\"fa-fw text-muted ";
                // line 82
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_0 = $context["event"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["itemtype_icon"] ?? null) : null), "html", null, true);
                yield "\"></i>
                                 <span>";
                // line 83
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_1 = $context["event"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["itemtype_name"] ?? null) : null), "html", null, true);
                yield "</span>
                              </td>
                              <td>";
                // line 85
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Glpi\\Event::displayItemLogID", [(($__internal_compile_2 = $context["event"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["type"] ?? null) : null), (($__internal_compile_3 = $context["event"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["items_id"] ?? null) : null)]);
                yield "</td>
                              <td>";
                // line 86
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime((($__internal_compile_4 = $context["event"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["date"] ?? null) : null)), "html", null, true);
                yield "</td>
                              <td>";
                // line 87
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((((CoreExtension::getAttribute($this->env, $this->source, ($context["services"] ?? null), (($__internal_compile_5 = $context["event"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["service"] ?? null) : null), [], "array", true, true, false, 87) &&  !(null === (($__internal_compile_6 = ($context["services"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[(($__internal_compile_7 = $context["event"]) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["service"] ?? null) : null)] ?? null) : null)))) ? ((($__internal_compile_8 = ($context["services"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[(($__internal_compile_9 = $context["event"]) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["service"] ?? null) : null)] ?? null) : null)) : ((($__internal_compile_10 = $context["event"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["service"] ?? null) : null))), "html", null, true);
                yield "</td>
                              <td>";
                // line 88
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_11 = $context["event"]) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["level"] ?? null) : null), "html", null, true);
                yield "</td>
                              <td>";
                // line 89
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_12 = $context["event"]) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["message"] ?? null) : null), "html", null, true);
                yield "</td>
                           </tr>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['event'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 92
            yield "                     </tbody>
                  </table>
               </div>

               <div class=\"search-footer card-footer\">
                  ";
            // line 97
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/pager.html.twig", ["href" => (            // line 98
($context["target"] ?? null) . "?"), "additional_params" => ((("sort=" .             // line 99
($context["sort"] ?? null)) . "&order=") . ($context["order"] ?? null)), "count" =>             // line 100
($context["count"] ?? null)]);
            // line 101
            yield "
               </div>
            ";
        }
        // line 104
        yield "         </div>
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
        return "pages/admin/events_list.html.twig";
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
        return array (  186 => 104,  181 => 101,  179 => 100,  178 => 99,  177 => 98,  176 => 97,  169 => 92,  160 => 89,  156 => 88,  152 => 87,  148 => 86,  144 => 85,  139 => 83,  135 => 82,  131 => 80,  127 => 79,  123 => 77,  112 => 73,  106 => 71,  103 => 70,  101 => 69,  93 => 68,  90 => 67,  86 => 66,  83 => 65,  81 => 57,  75 => 53,  69 => 50,  66 => 49,  64 => 47,  63 => 46,  61 => 45,  59 => 44,  56 => 43,  50 => 40,  47 => 39,  45 => 38,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "pages/admin/events_list.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\pages\\admin\\events_list.html.twig");
    }
}
