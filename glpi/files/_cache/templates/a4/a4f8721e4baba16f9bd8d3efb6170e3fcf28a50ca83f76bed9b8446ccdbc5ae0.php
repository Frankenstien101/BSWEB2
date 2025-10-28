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

/* components/kanban/kanban.html.twig */
class __TwigTemplate_de8c37835fb444ef359181548b09bbc03e707648cee6721b4c5c28d852c620c9 extends Template
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
        $macros["modals"] = $this->macros["modals"] = $this->loadTemplate("components/form/modals_macros.html.twig", "components/kanban/kanban.html.twig", 34)->unwrap();
        // line 35
        yield "
";
        // line 36
        if ( !array_key_exists("rights", $context)) {
            // line 37
            yield "   ";
            $context["rights"] = ["create_item" => false, "delete_item" => false, "create_column" => false, "modify_view" => false, "order_card" => false, "create_card_limited_columns" => [0]];
        }
        // line 46
        yield "
<div id=\"kanban\" class=\"kanban\"></div>
";
        // line 48
        yield CoreExtension::callMacro($macros["modals"], "macro_modal", ["", "", ["id" => "kanban-modal"]], 48, $context, $this->getSourceContext());
        // line 50
        yield "

";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["supported_itemtypes"] ?? null));
        foreach ($context['_seq'] as $context["supported_itemtype"] => $context["info"]) {
            // line 53
            yield "   <template id=\"kanban-teammember-item-dropdown-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["supported_itemtype"], "html", null, true);
            yield "\">
   </template>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['supported_itemtype'], $context['info'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        yield "
<script>
   \$(function(){
      // Create Kanban
      var kanban = new GLPIKanban({
         element: \"#";
        // line 61
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("kanban_id", $context)) ? (Twig\Extension\CoreExtension::default(($context["kanban_id"] ?? null), "kanban")) : ("kanban")), "html", null, true);
        yield "\",
         rights: ";
        // line 62
        yield json_encode(($context["rights"] ?? null));
        yield ",
         supported_itemtypes: ";
        // line 63
        yield json_encode(($context["supported_itemtypes"] ?? null));
        yield ",
         max_team_images: 3,
         column_field: ";
        // line 65
        yield json_encode(($context["column_field"] ?? null));
        yield ",
         background_refresh_interval: ";
        // line 66
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("background_refresh_interval", $context)) ? (Twig\Extension\CoreExtension::default(($context["background_refresh_interval"] ?? null), $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpirefresh_views"))) : ($this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpirefresh_views"))), "html", null, true);
        yield ",
         item: ";
        // line 67
        yield json_encode(($context["item"] ?? null));
        yield ",
         supported_filters: ";
        // line 68
        yield json_encode(($context["supported_filters"] ?? null));
        yield ",
         display_initials: ";
        // line 69
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->getEntityConfig("display_users_initials", $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactive_entity")), "html", null, true);
        yield ",
      });
      // Create kanban elements and add data
      kanban.init();
   });
</script>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/kanban/kanban.html.twig";
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
        return array (  112 => 69,  108 => 68,  104 => 67,  100 => 66,  96 => 65,  91 => 63,  87 => 62,  83 => 61,  76 => 56,  66 => 53,  62 => 52,  58 => 50,  56 => 48,  52 => 46,  48 => 37,  46 => 36,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/kanban/kanban.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\kanban\\kanban.html.twig");
    }
}
