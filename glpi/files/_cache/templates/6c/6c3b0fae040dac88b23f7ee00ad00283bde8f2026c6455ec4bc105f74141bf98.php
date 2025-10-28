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

/* components/checkbox_matrix.html.twig */
class __TwigTemplate_43b1752e6d321e67a67ec5236735fb8103d7116b0da4b92d2a9a1b524ecec752 extends Template
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
<div class=\"mx-n2 mb-4\">
   <table class=\"table table-hover card-table\">
      <thead>
         <tr class=\"border-top\">
            <th colspan=\"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["number_columns"] ?? null), "html", null, true);
        yield "\">
               <h4>";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield "</h4>
            </th>
         </tr>
         <tr>
            <th>";
        // line 43
        yield (($__internal_compile_0 = ($context["param"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["first_cell"] ?? null) : null);
        yield "</th>
            ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["columns"] ?? null));
        foreach ($context['_seq'] as $context["col_name"] => $context["column"]) {
            // line 45
            yield "               ";
            $context["col_id"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::cleanId", [((("col_label_" . $context["col_name"]) . "_") . (($__internal_compile_1 = ($context["param"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["rand"] ?? null) : null))]);
            // line 46
            yield "               <th id=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["col_id"] ?? null), "html", null, true);
            yield "\">
                  ";
            // line 47
            if ( !is_iterable($context["column"])) {
                // line 48
                yield "                     ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["column"], "html", null, true);
                yield "
                  ";
            } else {
                // line 50
                yield "                     ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["column"], "short", [], "array", true, true, false, 50) && CoreExtension::getAttribute($this->env, $this->source, $context["column"], "long", [], "array", true, true, false, 50))) {
                    // line 51
                    yield "                        ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_2 = $context["column"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["short"] ?? null) : null), "html", null, true);
                    yield "
                        ";
                    // line 52
                    $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::showToolTip", [(($__internal_compile_3 = $context["column"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["long"] ?? null) : null), ["applyto" => ($context["col_id"] ?? null)]]);
                    // line 53
                    yield "                     ";
                } else {
                    // line 54
                    yield "                        ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_4 = $context["column"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["label"] ?? null) : null), "html", null, true);
                    yield "
                     ";
                }
                // line 56
                yield "                  ";
            }
            // line 57
            yield "               </th>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['col_name'], $context['column'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        yield "
            ";
        // line 60
        if ((($__internal_compile_5 = ($context["param"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["row_check_all"] ?? null) : null)) {
            // line 61
            yield "               ";
            $context["col_id"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::cleanId", [("col_of_table_" . (($__internal_compile_6 = ($context["param"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["rand"] ?? null) : null))]);
            // line 62
            yield "               <th id=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["col_id"] ?? null), "html", null, true);
            yield "\">
                  ";
            // line 63
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Select/unselect all"), "html", null, true);
            yield "
               </th>
            ";
        }
        // line 66
        yield "         </tr>
      </thead>
      <tbody>
         ";
        // line 69
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["rows"] ?? null));
        foreach ($context['_seq'] as $context["row_name"] => $context["row"]) {
            // line 70
            yield "            <tr>
               ";
            // line 71
            if ( !is_iterable($context["row"])) {
                // line 72
                yield "                  <td colspan=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["number_columns"] ?? null), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["row"], "html", null, true);
                yield "</td>
               ";
            } else {
                // line 74
                yield "                  ";
                $context["row_id"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::cleanId", [((("row_label_" . $context["row_name"]) . "_") . (($__internal_compile_7 = ($context["param"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["rand"] ?? null) : null))]);
                // line 75
                yield "                  <td class=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_8 = $context["row"]) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["class"] ?? null) : null), "html", null, true);
                yield "\" id=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["row_id"] ?? null), "html", null, true);
                yield "\">
                     ";
                // line 76
                (((CoreExtension::getAttribute($this->env, $this->source, $context["row"], "label", [], "array", true, true, false, 76) &&  !(null === (($__internal_compile_9 = $context["row"]) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["label"] ?? null) : null)))) ? (yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_10 = $context["row"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["label"] ?? null) : null), "html", null, true)) : (yield "&nbsp;"));
                yield "
                  </td>

                  ";
                // line 79
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["columns"] ?? null));
                foreach ($context['_seq'] as $context["col_name"] => $context["column"]) {
                    // line 80
                    yield "                     ";
                    $context["content"] = (($__internal_compile_11 = (($__internal_compile_12 = $context["row"]) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["columns"] ?? null) : null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11[$context["col_name"]] ?? null) : null);
                    // line 81
                    yield "                     <td>
                        ";
                    // line 82
                    if ((is_iterable(($context["content"] ?? null)) && CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "checked", [], "array", true, true, false, 82))) {
                        // line 83
                        yield "                           ";
                        if ( !CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "readonly", [], "array", true, true, false, 83)) {
                            // line 84
                            yield "                              ";
                            $context["content"] = Twig\Extension\CoreExtension::merge(($context["content"] ?? null), ["readonly" => false]);
                            // line 85
                            yield "                           ";
                        }
                        // line 86
                        yield "                           ";
                        $context["content"] = Twig\Extension\CoreExtension::merge(($context["content"] ?? null), ["name" => (((                        // line 87
$context["row_name"] . "[") . $context["col_name"]) . "]"), "id" => $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::cleanId", [((((("cb_" .                         // line 88
$context["row_name"]) . "_") . $context["col_name"]) . "_") . (($__internal_compile_13 = ($context["param"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["rand"] ?? null) : null))])]);
                        // line 90
                        yield "                           ";
                        $context["massive_tags"] = [];
                        // line 91
                        yield "                           ";
                        if ((($__internal_compile_14 = ($context["param"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["row_check_all"] ?? null) : null)) {
                            // line 92
                            yield "                              ";
                            $context["massive_tags"] = Twig\Extension\CoreExtension::merge(($context["massive_tags"] ?? null), [((("row_" .                             // line 93
$context["row_name"]) . "_") . (($__internal_compile_15 = ($context["param"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["rand"] ?? null) : null))]);
                            // line 95
                            yield "                           ";
                        }
                        // line 96
                        yield "                           ";
                        if ((($__internal_compile_16 = ($context["param"] ?? null)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["col_check_all"] ?? null) : null)) {
                            // line 97
                            yield "                              ";
                            $context["massive_tags"] = Twig\Extension\CoreExtension::merge(($context["massive_tags"] ?? null), [((("col_" .                             // line 98
$context["col_name"]) . "_") . (($__internal_compile_17 = ($context["param"] ?? null)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["rand"] ?? null) : null))]);
                            // line 100
                            yield "                           ";
                        }
                        // line 101
                        yield "                           ";
                        if (((($__internal_compile_18 = ($context["param"] ?? null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["row_check_all"] ?? null) : null) && (($__internal_compile_19 = ($context["param"] ?? null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["col_check_all"] ?? null) : null))) {
                            // line 102
                            yield "                              ";
                            $context["massive_tags"] = Twig\Extension\CoreExtension::merge(($context["massive_tags"] ?? null), [("table_" . (($__internal_compile_20 =                             // line 103
($context["param"] ?? null)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["rand"] ?? null) : null))]);
                            // line 105
                            yield "                           ";
                        }
                        // line 106
                        yield "                           ";
                        $context["content"] = Twig\Extension\CoreExtension::merge(($context["content"] ?? null), ["massive_tags" =>                         // line 107
($context["massive_tags"] ?? null)]);
                        // line 109
                        yield "                           ";
                        $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::showCheckbox", [($context["content"] ?? null)]);
                        // line 110
                        yield "
                        ";
                    } else {
                        // line 112
                        yield "                           ";
                        if ( !is_iterable(($context["content"] ?? null))) {
                            // line 113
                            yield "                              ";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["content"] ?? null), "html", null, true);
                            yield "
                           ";
                        }
                        // line 115
                        yield "                        ";
                    }
                    // line 116
                    yield "                     </td>
                  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['col_name'], $context['column'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 118
                yield "
                  ";
                // line 119
                if ((($__internal_compile_21 = ($context["param"] ?? null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["row_check_all"] ?? null) : null)) {
                    // line 120
                    yield "                     <td>
                        ";
                    // line 121
                    $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::showCheckbox", [["title" => __("Check/uncheck all"), "criterion" => ["tag_for_massive" => ((("row_" .                     // line 124
$context["row_name"]) . "_") . (($__internal_compile_22 = ($context["param"] ?? null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["rand"] ?? null) : null))], "massive_tags" => ("table_" . (($__internal_compile_23 =                     // line 126
($context["param"] ?? null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["rand"] ?? null) : null)), "id" => $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::cleanId", [((("cb_checkall_row_" .                     // line 127
$context["row_name"]) . "_") . (($__internal_compile_24 = ($context["param"] ?? null)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["rand"] ?? null) : null))]), "checked" => (0 <= CoreExtension::compare((($__internal_compile_25 = (($__internal_compile_26 =                     // line 128
($context["nb_cb_per_row"] ?? null)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26[$context["row_name"]] ?? null) : null)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["checked"] ?? null) : null), (($__internal_compile_27 = (($__internal_compile_28 = ($context["nb_cb_per_row"] ?? null)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28[$context["row_name"]] ?? null) : null)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["total"] ?? null) : null)))]]);
                    // line 130
                    yield "                     </td>
                  ";
                }
                // line 132
                yield "               ";
            }
            // line 133
            yield "            </tr>
         ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['row_name'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 135
        yield "
         ";
        // line 136
        if ((($__internal_compile_29 = ($context["param"] ?? null)) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["col_check_all"] ?? null) : null)) {
            // line 137
            yield "            <tr>
               <td>";
            // line 138
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Select/unselect all"), "html", null, true);
            yield "</td>
               ";
            // line 139
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["columns"] ?? null));
            foreach ($context['_seq'] as $context["col_name"] => $context["column"]) {
                // line 140
                yield "                  <td>
                     ";
                // line 141
                if ((0 <= CoreExtension::compare((($__internal_compile_30 = (($__internal_compile_31 = ($context["nb_cb_per_col"] ?? null)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31[$context["col_name"]] ?? null) : null)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["total"] ?? null) : null), 2))) {
                    // line 142
                    yield "                        ";
                    $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::showCheckbox", [["title" => __("Check/uncheck all"), "criterion" => ["tag_for_massive" => ((("col_" .                     // line 145
$context["col_name"]) . "_") . (($__internal_compile_32 = ($context["param"] ?? null)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32["rand"] ?? null) : null))], "massive_tags" => ("table_" . (($__internal_compile_33 =                     // line 147
($context["param"] ?? null)) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33["rand"] ?? null) : null)), "id" => $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::cleanId", [(("cb_checkall_col_" .                     // line 148
$context["col_name"]) . (($__internal_compile_34 = ($context["param"] ?? null)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34["rand"] ?? null) : null))]), "checked" => (0 <= CoreExtension::compare((($__internal_compile_35 = (($__internal_compile_36 =                     // line 149
($context["nb_cb_per_col"] ?? null)) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36[$context["col_name"]] ?? null) : null)) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35["checked"] ?? null) : null), (($__internal_compile_37 = (($__internal_compile_38 = ($context["nb_cb_per_col"] ?? null)) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38[$context["col_name"]] ?? null) : null)) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37["total"] ?? null) : null)))]]);
                    // line 151
                    yield "                     ";
                }
                // line 152
                yield "                  </td>
               ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['col_name'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 154
            yield "
               ";
            // line 155
            if ((($__internal_compile_39 = ($context["param"] ?? null)) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39["row_check_all"] ?? null) : null)) {
                // line 156
                yield "                  <td>
                     ";
                // line 157
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::showCheckbox", [["title" => __("Check/uncheck all"), "criterion" => ["tag_for_massive" => ("table_" . (($__internal_compile_40 =                 // line 160
($context["param"] ?? null)) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40["rand"] ?? null) : null))], "massive_tags" => "", "id" => $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::cleanId", [("cb_checkall_table_" . (($__internal_compile_41 =                 // line 163
($context["param"] ?? null)) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41["rand"] ?? null) : null))])]]);
                // line 165
                yield "                  </td>
               ";
            }
            // line 167
            yield "            </tr>
         ";
        }
        // line 169
        yield "      </tbody>
   </table>
</div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/checkbox_matrix.html.twig";
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
        return array (  341 => 169,  337 => 167,  333 => 165,  331 => 163,  330 => 160,  329 => 157,  326 => 156,  324 => 155,  321 => 154,  314 => 152,  311 => 151,  309 => 149,  308 => 148,  307 => 147,  306 => 145,  304 => 142,  302 => 141,  299 => 140,  295 => 139,  291 => 138,  288 => 137,  286 => 136,  283 => 135,  276 => 133,  273 => 132,  269 => 130,  267 => 128,  266 => 127,  265 => 126,  264 => 124,  263 => 121,  260 => 120,  258 => 119,  255 => 118,  248 => 116,  245 => 115,  239 => 113,  236 => 112,  232 => 110,  229 => 109,  227 => 107,  225 => 106,  222 => 105,  220 => 103,  218 => 102,  215 => 101,  212 => 100,  210 => 98,  208 => 97,  205 => 96,  202 => 95,  200 => 93,  198 => 92,  195 => 91,  192 => 90,  190 => 88,  189 => 87,  187 => 86,  184 => 85,  181 => 84,  178 => 83,  176 => 82,  173 => 81,  170 => 80,  166 => 79,  160 => 76,  153 => 75,  150 => 74,  142 => 72,  140 => 71,  137 => 70,  133 => 69,  128 => 66,  122 => 63,  117 => 62,  114 => 61,  112 => 60,  109 => 59,  102 => 57,  99 => 56,  93 => 54,  90 => 53,  88 => 52,  83 => 51,  80 => 50,  74 => 48,  72 => 47,  67 => 46,  64 => 45,  60 => 44,  56 => 43,  49 => 39,  45 => 38,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/checkbox_matrix.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\checkbox_matrix.html.twig");
    }
}
