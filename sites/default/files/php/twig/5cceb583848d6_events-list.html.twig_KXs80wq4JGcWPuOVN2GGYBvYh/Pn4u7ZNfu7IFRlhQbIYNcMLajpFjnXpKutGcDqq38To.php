<?php

/* modules/custom/event_module/templates/events-list.html.twig */
class __TwigTemplate_4ebdfd43fe4cd871c34e58fda8bcb9e28ceb33a9fea74b3521167009d174cd53 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("if" => 25, "set" => 26, "for" => 27);
        $filters = array("slice" => 26, "t" => 29, "date" => 30, "raw" => 32);
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('if', 'set', 'for'),
                array('slice', 't', 'date', 'raw'),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 23
        echo "<article class=\"event_module\">

";
        // line 25
        if (($context["events"] ?? null)) {
            // line 26
            echo "    ";
            $context["events_data"] = twig_slice($this->env, ($context["events"] ?? null), 0,  -1);
            // line 27
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["events_data"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
                // line 28
                echo "      <h2 class=\"title\"><a href=\"/content/event_entity/";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["event"], "id", array()), "html", null, true));
                echo "\">";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["event"], "name", array()), "html", null, true));
                echo "</a></h2>
      <div class=\"field_event_type\"><span><strong>";
                // line 29
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Event Type")));
                echo " :</strong></span> ";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["event"], "t_name", array()), "html", null, true));
                echo "</div>
      <div class=\"field_event_date\"><span><strong>";
                // line 30
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Event Date")));
                echo " :</strong></span> ";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["event"], "event_date", array()), "d M Y"), "html", null, true));
                echo "</div>
      <div class=\"field_event_venue\"><span><strong>";
                // line 31
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Event Venue")));
                echo " :</strong></span> ";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["event"], "venue", array()), "html", null, true));
                echo "</div>
      <div class=\"field_event_details\"><span><strong>";
                // line 32
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Event Details")));
                echo "</strong></span> : ";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute($context["event"], "description__value", array())));
                echo "</div>
      <div class=\"event-subscribe-wrapper\"><input type=\"checkbox\" name=\"chk_subscribe[]\" class=\"event-subscribe-checkbox form-control\" value=\"";
                // line 33
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["event"], "id", array()), "html", null, true));
                echo "\"><span><strong> ";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Subscribe")));
                echo "</strong></span></div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['event'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "    ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["events"] ?? null), "pager", array()), "html", null, true));
            echo "
";
        } else {
            // line 37
            echo "    <h3>";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("No any events found.")));
            echo "</h3> 
";
        }
        // line 39
        echo "</article>

";
    }

    public function getTemplateName()
    {
        return "modules/custom/event_module/templates/events-list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 39,  104 => 37,  98 => 35,  88 => 33,  82 => 32,  76 => 31,  70 => 30,  64 => 29,  57 => 28,  52 => 27,  49 => 26,  47 => 25,  43 => 23,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "modules/custom/event_module/templates/events-list.html.twig", "D:\\project\\drupal\\modules\\custom\\event_module\\templates\\events-list.html.twig");
    }
}
