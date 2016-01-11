<?php

namespace ConsultaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ConsultaBundle\Form\Type\ConsultaType as ConsultaForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_USER')")
 */
class ConsultaController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ConsultaBundle:Default:index.html.twig', array('name' => $name));
    }

    public function consultarPacienteAction(Request $request)
    {
        $repositoryPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
        $cantidadPacientes = $repositoryPaciente
                ->createQueryBuilder('p')
                ->select('COUNT(p.id)')
                ->leftJoin('p.ingreso', 'ingreso')
                ->getQuery()
                ->getSingleScalarResult();

        $formConsultas = $this->createForm(
            new ConsultaForm()
        );

        $formConsultas->handleRequest($request);

        if (!$formConsultas->isValid()) {
            return $this->render(
                'ConsultaBundle:Consulta:consultaPaciente.html.twig',
                [
                    'form' => $formConsultas->createView(),
                    'pacientes' => null,
                    'contPacientes' => $cantidadPacientes,
                ]
            );
        }

        $dataForm = $formConsultas->getData();

        $pacientes = [];
        $qb = $repositoryPaciente->createQueryBuilder('p');

        if (isset($dataForm['consulta_dpi_nombre_apellidos'])) {
            $pacientes[] = $dataForm['consulta_dpi_nombre_apellidos'];

            return $this->render(
                'ConsultaBundle:Consulta:consultaPaciente.html.twig',
                [
                    'form' => $formConsultas->createView(),
                    'pacientes' => $pacientes,
                    'contPacientes' => $cantidadPacientes,
                ]
            );
        }

        if (isset($dataForm['consulta_fecha_ingreso'])) {
            $fecha = $dataForm['consulta_fecha_ingreso'];
            $fechaInicio = $fecha->format('Y-m-d');
            $fecha = $fecha->modify('+1 day');
            $fechaFin = $fecha->format('Y-m-d');

            $qb = $this->consultaPorFechas($qb, $fechaInicio, $fechaFin);

        }

        if (isset($dataForm['consulta_procedimiento_realizado'])) {
            $procedimiento = $dataForm['consulta_procedimiento_realizado'];

            $qb = $this->consultaPorProcedimiento($qb, $procedimiento);
        }

        if (isset($dataForm['consulta_diagnostico'])) {
            echo('consulta por diagnostico');
            $diagnostico = $dataForm['consulta_procedimiento_realizado'];

            $qb = $this->consultaPorDiagnostico($qb, $diagnostico);
        }

        $pacientes = $qb->getQuery()->getResult();

        return $this->render(
            'ConsultaBundle:Consulta:consultaPaciente.html.twig',
            [
                'form' => $formConsultas->createView(),
                'pacientes' => $pacientes,
                'contPacientes' => $cantidadPacientes,
            ]
        );
    }

    private function consultaPorFechas($qb, $fechaInicio, $fechaFin)
    {
        $fechaInicio = $fecha->format('Y-m-d');
        $fechaFin = $fecha->format('Y-m-d');

        return $qb
            ->leftJoin('p.ingreso', 'ingreso')
            ->andWhere('ingreso.fechaIngreso >= :fechaInicio')
            ->andWhere('ingreso.fechaIngreso < :fechaFin')
            ->setParameters([
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
            ]
        );
    }

    private function consultaPorProcedimiento($qb, $procedimiento)
    {
        return $qb
            ->leftJoin('p.ingreso', 'ingreso')
            ->andWhere('ingreso.procedimientoRealizado = :procedimiento')
            ->setParameter('procedimiento', $procedimiento);
    }

    private function consultaPorDiagnostico($qb, $diagnostico)
    {

    }
}
